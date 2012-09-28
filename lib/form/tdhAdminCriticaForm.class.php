<?php

class tdhAdminCriticaForm extends tdhContenidoForm
{
  const APP_SIZES = 'app_sizes_criticas';
  
  protected $methodResource = 'getCritica';
	
  public function configure()
	{
		parent::configure();
		
		// Imagen
		$this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Portada',
      'file_src'     => !$this->isNew() ? $this->getObject()->getCritica()->getCoverPath() : '',
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir esta imagen',
      'with_delete'  => !$this->isNew() && $this->getObject()->getCritica()->hasCover() ? true : false,
      'template'     => !$this->isNew() && $this->getObject()->getCritica()->hasCover() ? '<div>%input%</div><div class="tdh_image_form">%delete% %delete_label%<br />%file%</div>' : '%input%',
		));
		
		$this->validatorSchema['image'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
		), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
		));
		
		$this->validatorSchema['image_delete'] = new sfValidatorPass();
		
		$this->configureSocialsFields();		
		
		$this->embedRelation('Critica', 'tdhCriticaForm');
		
		// Podemos marcar una sección por defecto
		if($this->getOption('seccion_id'))
		{
		  $this->getEmbeddedForm('Critica')->setDefault('seccion_id', $this->getOption('seccion_id'));
		}
		
		if($this->haveNoticia())
	  {
	    $this->embedRelation('Noticia', 'tdhNoticiaForm');
	  }
	}
	
  public function doSave($con = null)
  {    
    $image   = $this->getValue('image');
    unset($this['image']);
    
    if($this->getValue('image_delete') == true)
    {
      $this->deleteImages();
    }
    
    parent::doSave($con);
    
    // Grabamos las imágenes y los PDFs
    if($image) $this->saveImages($image);
    
    // Envíamos los enlaces sociales
    $this->sendSocials();
  }
  
  protected function deleteImages()
  {
    $sizes = sfConfig::get(self::APP_SIZES, array());
  
    foreach($sizes as $name => $size)
    {
      @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getCritica()->getCoverPath($name));
    }
  }
  
  protected function saveImages($image)
  {
    $sizes = sfConfig::get(self::APP_SIZES, array());
  
    foreach($sizes as $name => $size)
    {
      $myImage = new ehUtilesImagen($image->getTempName());
      
      $myImage
        ->setFormatoSalida(ehUtilesImagen::FORMATO_JPG)
        ->setModoRedimension(isset($size['ajuste']) ? $size['ajuste'] : ehUtilesImagen::AJUSTE_ADAPTATIVO)
        ->setFicheroDestino(sfConfig::get('sf_web_dir').$this->getObject()->getCritica()->getCoverPath($name, false))
        ->setMaxAlto($size['y'])
        ->setMaxAncho($size['x'])
        ->save();
    }
  }
} 