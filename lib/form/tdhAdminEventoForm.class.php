<?php

class tdhAdminEventoForm extends tdhContenidoForm
{
	protected $methodResource = 'getEvento';
	
	const APP_SIZES = 'app_sizes_eventos';
	
  public function configure()
	{
		parent::configure();
		
		if($this->isNew())
		{
		  //$this->setWidget('tablon_id', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tablon'), 'add_empty' => false)));
		  $this->setWidget('tablon_id', new sfWidgetFormChoice(array('choices' => Doctrine::getTable('ehForoTablon')->retrieveArrayFormList())));
		  $this->setValidator('tablon_id', new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tablon'))));
		  $this->getWidgetSchema()->setLabel('tablon_id', 'Tablón');
		  
		  if($tablon = Doctrine::getTable('ehForoTablon')->findOneBy('slug', tdhConfig::get('foro_slug_generico_eventos', 'eventos')))
		  {
		    $this->setDefault('tablon_id', $tablon->getId());
		  }
		}
		
		$this->configureSocialsFields();
		$this->configureImageFields();
		
		$this->embedRelation('Evento', 'tdhEventoForm');
	}
	
	public function configureImageFields()
	{
	  $methodResource = $this->methodResource;
	  
	  $this->widgetSchema['imagen'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Póster',
      'file_src'     => $this->isNew() ? '' : $this->getObject()->$methodResource()->getImagePath('peq', false),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir este póster',
      'with_delete'  => $this->isNew() ? false : ($this->getObject()->$methodResource()->hasImage() ? true : false),
      'template'     => $this->isNew() ? '%input%' : ($this->getObject()->$methodResource()->hasImage() ? '<div>%input%<br />%delete% %delete_label%<br />%file%</div>' : '%input%'),
	  ));
	
	  $this->validatorSchema['imagen'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
	  ), array(
      'required' => 'Se require póster',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
	  ));
	
	  $this->validatorSchema['imagen_delete'] = new sfValidatorPass();
	}
	
	protected function saveImages($image)
	{
	  $methodResource = $this->methodResource;
	  
	  if(!$image) return false;
	
	  $sizes = sfConfig::get(self::APP_SIZES, array());
	
	  foreach($sizes as $name => $size)
	  {
	    $myImage = new ehUtilesImagen($image->getTempName());
	
	    $myImage
  	    ->setFormatoSalida(ehUtilesImagen::FORMATO_JPG)
  	    ->setModoRedimension(isset($size['ajuste']) ? $size['ajuste'] : ehUtilesImagen::AJUSTE_ADAPTATIVO)
  	    ->setFicheroDestino(sfConfig::get('sf_web_dir').$this->getObject()->$methodResource()->getImagePath($name, false))
  	    ->setMaxAlto($size['y'])
  	    ->setMaxAncho($size['x'])
  	    ->save();
	  }
	}
	
	protected function deleteImages()
	{
	  $methodResource = $this->methodResource;
	  $sizes = sfConfig::get(self::APP_SIZES, array());
	
	  foreach($sizes as $name => $size)
	  {
	    @unlink(sfConfig::get('sf_web_dir').$this->getObject()->$methodResource()->getImagePath($name));
	  }
	}
	
  public function doSave($con = null)
  {    
    $imagen = $this->getValue('imagen');
    unset($this['imagen']);
    
    if($this->getValue('image_delete') == true)
    {
      $this->deleteImages();
    }
    
    parent::doSave($con);
    
    // Grabamos las imágenes del
    $this->saveImages($imagen);
    
    // Envíamos los enlaces sociales
    $this->sendSocials();
  }
} 