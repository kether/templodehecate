<?php

class tdhAdminRecursoForm extends tdhContenidoForm
{
  const APP_SIZES = 'app_sizes_recursos';
  
  protected $methodResource = 'getRecurso';
	
  public function configure()
	{
		parent::configure();
		
		// Imagen
		$this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Imagen',
      'file_src'     => !$this->isNew() ? $this->getObject()->getRecurso()->getImagePath() : '',
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir esta imagen',
      'with_delete'  => !$this->isNew() && $this->getObject()->getRecurso()->hasImage() ? true : false,
      'template'     => !$this->isNew() &&  $this->getObject()->getRecurso()->hasImage() ? '<div>%input%</div><div class="tdh_image_form">%delete% %delete_label%<br />%file%</div>' : '%input%',
		));
		
		$this->validatorSchema['image'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
		), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
		));
		
		$this->validatorSchema['image_delete'] = new sfValidatorPass();
		
		// PDF
		$this->widgetSchema['pdf'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'PDF',
      'file_src'     => !$this->isNew() ? $this->getObject()->getRecurso()->getPdfPath(true) : '',
      'is_image'     => false,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir este PDF',
      'with_delete'  => !$this->isNew() && $this->getObject()->getRecurso()->hasPdf(true) ? true : false,
      'template'     => !$this->isNew() && $this->getObject()->getRecurso()->hasPdf(true) ? '<div>%input%</div><div class="tdh_image_form">%delete% %delete_label%</div>' : '%input%',
		));
		
    $this->validatorSchema['pdf'] = new sfValidatorFile(array('required' => false, 'mime_types' => array('application/pdf')), array('mime_types' => 'Sólo se aceptan ficheros en PDF'));
    $this->validatorSchema['pdf_delete'] = new sfValidatorPass();
		
		$this->getWidgetSchema()->setLabels(array(
      'direccion'	=> 'Dirección', 
      'web' => 'Sitio web', 
      'pais' => 'País',
      'region' => 'Región',
      'descripcion' => 'Descripción'
		));
		
		$this->configureSocialsFields();
		$this->embedRelation('Recurso', 'tdhRecursoForm');
		
		if($this->getOption('seccion_id'))
		{
		  $this->getEmbeddedForm('Recurso')->setDefault('seccion_id', $this->getOption('seccion_id'));
		}
		
		if($this->haveNoticia())
		{
		  $this->embedRelation('Noticia', 'tdhNoticiaForm');
		}
	}
	
  public function doSave($con = null)
  {    
    $image   = $this->getValue('image');
    $pdf     = $this->getValue('pdf');
    
    unset($this['image']);
    unset($this['pdf']);
     
    if($this->getValue('image_delete') == true)
    {
      $this->deleteImages();
    }
    
    if($this->getValue('pdf_delete') == true)
    {
      $this->deletePdf();
    }
    
    parent::doSave($con);
    
    // Grabamos las imágenes y los PDFs
    if($image) $this->saveImages($image);
    if($pdf) $this->savePdf($pdf);
    
    // Envíamos los enlaces sociales
    $this->sendSocials();
  }
  
  protected function deleteImages()
  {
    $sizes = sfConfig::get(self::APP_SIZES, array());
  
    foreach($sizes as $name => $size)
    {
      @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getRecurso()->getImagePath($name));
    }
  }
  
  /**
   * Borra el PDF opcional del recurso
   */
  protected function deletePdf()
  {
    @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getRecurso()->getPdfPath());
  }
  
  /**
   * Graba el PDF en la ruta de recursos
   * 
   * @param sfValidateFile $pdf
   */
  protected function savePdf($pdf)
  {
    $pdf->save(sfConfig::get('sf_web_dir').'/'.$this->getObject()->getRecurso()->getPdfPath(true));
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
        ->setFicheroDestino(sfConfig::get('sf_web_dir').$this->getObject()->getRecurso()->getImagePath($name))
        ->setMaxAlto($size['y'])
        ->setMaxAncho($size['x'])
        ->save();
    }
  }
} 