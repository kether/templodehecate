<?php

/**
 * tdhSeccion form.
 *
 * @package    form
 * @subpackage tdhSeccion
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhSeccionForm extends BasetdhSeccionForm
{  
  public function configure()
  {
    $this->useFields(array(
      'estado_activa',
      'nombre',
      'nombre_original',
      'url',
      'descripcion',
      'color_menu',
      'tipo_id',
      'editor_id',
      'genero_id',
      'tablon_id',
      'hojas_de_estilo_list'
    ));
    
    $this->getWidgetSchema()->setLabels(array(
      'color_menu'	=> 'Color del menu'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
      'color_menu'	=> 'Selecciona un color del menú en hexadecimal'
    ));
    
    $this->widgetSchema['tablon_id'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('ehForoTablon')->retrieveArrayFormList()));
    
    // Imagen
    $this->widgetSchema['imagen'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Imagen',
      'file_src'     => $this->isNew() ? '' : $this->getObject()->getImagen('thumb', false, true),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir esta imagen',
      'with_delete'  => $this->isNew() ? false : ($this->getObject()->getImagen('thumb', false, true) ? true : false),
      'template'     => $this->isNew() ? '%input%' : ($this->getObject()->getImagen('thumb', false, true) ? '<div>%input%<br />%delete% %delete_label%<br />%file%</div>' : '%input%'),
    ));
    
    $this->validatorSchema['imagen'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
    ), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
    ));
    
    $this->validatorSchema['imagen_delete'] = new sfValidatorPass();
    
    // Icono
    $this->widgetSchema['icono'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Icono',
      'file_src'     => $this->isNew() ? '' : $this->getObject()->getImagen('icon', false, true),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir este icono',
      'with_delete'  => $this->isNew() ? false : ($this->getObject()->getImagen('icon', false, true) ? true : false),
      'template'     => $this->isNew() ? '%input%' : ($this->getObject()->getImagen('icon', false, true) ? '<div>%input%<br />%delete% %delete_label%<br />%file%</div>' : '%input%'),
    ));
    
    $this->validatorSchema['icono'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
    ), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
    ));
    
    $this->validatorSchema['icono_delete'] = new sfValidatorPass();
    
    // Portada
    $this->widgetSchema['cover'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Portada',
      'file_src'     => $this->isNew() ? '' : $this->getObject()->getCoverPath('covmed', false),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir esta portada',
      'with_delete'  => $this->isNew() ? false : ($this->getObject()->hasCover() ? true : false),
      'template'     => $this->isNew() ? '%input%' : ($this->getObject()->hasCover() ? '<div>%input%<br />%delete% %delete_label%<br />%file%</div>' : '%input%'),
    ));
    
    $this->validatorSchema['cover'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
    ), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
    ));
    
    $this->validatorSchema['cover_delete'] = new sfValidatorPass();
    
    // Logotipo
    $this->widgetSchema['logotipo'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Logotipo',
      'file_src'     => $this->isNew() ? '' : $this->getObject()->getLogo(),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir este logotipo',
      'with_delete'  => $this->isNew() ? false : ($this->getObject()->getLogo() ? true : false),
      'template'     => $this->isNew() ? '%input%' : ($this->getObject()->getLogo() ? '<div>%input%<br />%delete% %delete_label%<br />%file%</div>' : '%input%'),
    ));
    
    $this->validatorSchema['logotipo'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
    ), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
    ));
    
    $this->validatorSchema['logotipo_delete'] = new sfValidatorPass();
    
    // Fondo
    $this->widgetSchema['fondo'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Fondo',
      'file_src'     => $this->isNew() ? '' : $this->getObject()->getFondo(),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir este fondo',
      'with_delete'  => $this->isNew() ? false : ($this->getObject()->getFondo() ? true : false),
      'template'     => $this->isNew() ? '%input%' : ($this->getObject()->getFondo() ? '<div>%input%<br />%delete% %delete_label%<br />Fondo cargado</div>' : '%input%'),
    ));
    
    $this->validatorSchema['fondo'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => array('image/jpeg')
    ), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg'
    ));
    
    $this->validatorSchema['fondo_delete'] = new sfValidatorPass();
  }
  
  public function saveImages($image, $icon)
  {
    $sizes = tdhConfig::getImageSectionSizes();
    
    if($image)
    {
	    $myImage = new ehUtilesImagen($image->getTempName());
	    
	    foreach($sizes as $nombre => $size)
	    {
	      if($nombre != 'icon' || (is_null($this->getObject()->getImagen($nombre, false, true)) && !$icon))
	      {
		      $myImage
		        ->setFicheroDestino($this->getObject()->getImagen($nombre, true, true))
		        ->setFormatoSalida(ehUtilesImagen::FORMATO_JPEG)
		        ->setModoRedimension(ehUtilesImagen::AJUSTE_ADAPTATIVO)
		        ->setMaxAlto($size['y'])
		        ->setMaxAncho($size['x'])
		        ->save();
	      }
	    }
    }
    
    if($icon)
    {
      $myImage = new ehUtilesImagen($icon->getTempName());
      
      $myImage
        ->setFicheroDestino($this->getObject()->getImagen('icon', true, true))
        ->setFormatoSalida(ehUtilesImagen::FORMATO_JPEG)
        ->setModoRedimension(ehUtilesImagen::AJUSTE_ADAPTATIVO)
        ->setMaxAlto($sizes['icon']['y'])
        ->setMaxAncho($sizes['icon']['x'])
        ->save();
    }
  }
  
  protected function saveCover($image)
  {
    $sizes = sfConfig::get(tdhAdminCriticaForm::APP_SIZES, array());
  
    foreach($sizes as $name => $size)
    {
      $myImage = new ehUtilesImagen($image->getTempName());
  
      $myImage
        ->setFormatoSalida(ehUtilesImagen::FORMATO_JPG)
        ->setModoRedimension(isset($size['ajuste']) ? $size['ajuste'] : ehUtilesImagen::AJUSTE_ADAPTATIVO)
        ->setFicheroDestino(sfConfig::get('sf_web_dir').$this->getObject()->getCoverPath($name, false))
        ->setMaxAlto($size['y'])
        ->setMaxAncho($size['x'])
        ->save();
    }
  }
  
  public function saveLogo($logo)
  {    
    $myImage = new ehUtilesImagen($logo->getTempName());
    
    $myImage
      ->setFicheroDestino(sfConfig::get('sf_web_dir').$this->getObject()->getLogo(false))
      ->setFormatoSalida(ehUtilesImagen::FORMATO_PNG)
      ->setModoRedimension(ehUtilesImagen::AJUSTE_MEJOR)
      ->setMaxAlto(tdhConfig::get('img_logo_sizey'))
      ->setMaxAncho(tdhConfig::get('img_logo_sizex'))
      ->save();
  }
  
  public function saveFondo($fondo)
  {
    $fondo->save(sfConfig::get('sf_web_dir').$this->getObject()->getFondo(false));
  }
  
  public function deleteImages()
  {
    $sizes = tdhConfig::getImageSectionSizes();
    
    foreach($sizes as $nombre => $size)
    {
      @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getImagen($nombre, true, true));
    }
  }
  
  public function doSave($con = null)
  {
    $image  = $this->getValue('imagen');
    $icon   = $this->getValue('icono');
    $logo   = $this->getValue('logotipo');
    $fondo  = $this->getValue('fondo');
    $cover  = $this->getValue('cover');
    
    unset($this['imagen']);
    unset($this['icono']);
    unset($this['logotipo']);
    unset($this['fondo']);
    unset($this['cover']);
    
    parent::doSave($con);
    
    // Imágenes de la sección
    if($image || $icon)
    {      
      $this->saveImages($image, $icon);
    }
    elseif($this->getValue('imagen_delete'))
    {
      $this->deleteImages();
    }
    
    // Logotipo de la sección
    if($logo)
    {
      $this->saveLogo($logo);
    }
    elseif($this->getValue('logotipo_delete'))
    {
      @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getLogo(false));
    }
    
    // Fondo de la sección
    if($fondo)
    {
      $this->saveFondo($fondo);
    }
    elseif($this->getValue('fondo_delete'))
    {
      @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getFondo(false));
    }
    
    // Portada de la sección
    if($cover)
    {
      $this->saveCover($cover);
    }
    elseif($this->getValue('cover_delete'))
    {
      $sizes = sfConfig::get(tdhAdminCriticaForm::APP_SIZES, array());
      
      foreach($sizes as $nombre => $size)
      {
        @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getCoverPath($nombre, false));
      }
    }
  }
}