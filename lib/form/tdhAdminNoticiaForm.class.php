<?php

class tdhAdminNoticiaForm extends tdhContenidoForm
{
	protected $methodResource = 'getNoticia';
	
	const APP_SIZES = 'app_sizes_noticias';
	
  public function configure()
	{
		parent::configure();
		
		$this->configureSocialsFields();
		$this->configureImageFields();
		
		$this->embedRelation('Noticia', 'tdhNoticiaForm');
		
		if($this->getOption('seccion_id'))
		{
		  $this->getEmbeddedForm('Noticia')->setDefault('seccion_id', $this->getOption('seccion_id'));
		}
	}
	
  public function configureImageFields()
  {    
    $this->widgetSchema['imagen'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Imagen',
      'file_src'     => $this->isNew() ? '' : $this->getObject()->getNoticia()->getImagePath('peq', false),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir esta imagen',
      'with_delete'  => $this->isNew() ? false : ($this->getObject()->getNoticia()->hasImage() ? true : false),
      'template'     => $this->isNew() ? '%input%' : ($this->getObject()->getNoticia()->hasImage() ? '<div>%input%<br />%delete% %delete_label%<br />%file%</div>' : '%input%'),
    ));
    
    $this->validatorSchema['imagen'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
    ), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
    ));
    
    $this->validatorSchema['imagen_delete'] = new sfValidatorPass();
  }
  
  protected function saveImages($image)
  {
    if(!$image) return false;
    
    $sizes = sfConfig::get(self::APP_SIZES, array());
  
    foreach($sizes as $name => $size)
    {
      $myImage = new ehUtilesImagen($image->getTempName());
  
      $myImage
        ->setFormatoSalida(ehUtilesImagen::FORMATO_JPG)
        ->setModoRedimension(isset($size['ajuste']) ? $size['ajuste'] : ehUtilesImagen::AJUSTE_ADAPTATIVO)
        ->setFicheroDestino(sfConfig::get('sf_web_dir').$this->getObject()->getNoticia()->getImagePath($name, false))
        ->setMaxAlto($size['y'])
        ->setMaxAncho($size['x'])
        ->save();
    }
  }
  
  protected function deleteImages()
  {
    $sizes = sfConfig::get(self::APP_SIZES, array());
  
    foreach($sizes as $name => $size)
    {
      @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getNoticia()->getImagePath($name));
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