<?php

/**
 * tdhSorteo form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhSorteoForm extends BasetdhSorteoForm
{
  public function configure()
  {
    $this->useFields(array(
      'estado_visible',
      'estado_abierto',
      'nombre',
      'entradilla',
      'descripcion',
      'mensaje',
      'desde',
      'hasta',
      'participantes_min',
      'participantes_max',
      'sufijo',
      'url',
      'semilla'
    ));
    
    $this->setWidget('desde', new sfWidgetFormI18nDateTime(array('culture' => sfConfig::get('sf_default_culture', 'es'))));
    $this->setWidget('hasta', new sfWidgetFormI18nDateTime(array('culture' => sfConfig::get('sf_default_culture', 'es'))));
    
    $this->setValidator('url', new sfValidatorUrl(array('required' => false)));
    
    $this->configureImageFields();
    
    $this->getWidgetSchema()->setLabels(array(
      'estado_visible'    => '¿Visible?',
      'estado_abierto'    => '¿Aprobado?',
      'descripcion'       => 'Descripción',
      'url'               => 'URL',
      'participantes_min' => 'Mínimo de participantes',
      'participantes_max' => 'Máximo de participantes',
      'mensaje'           => 'Mensaje por defecto'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
      'url' => 'Link que aparecerá en los muros de Facebook',
      'mensaje' => 'Éste es el mensaje por defecto que aparecerá para ser enviado a los timeline de Twitter o muros de Facebook',
      'sufijo' => 'Sufijo que aparecerá en los timeline de Twitter (ejemplo: "http://bit.ly/templodehecate #tdh")',
      'semilla' => 'Un número al azar para determinar el ganador del sorteo mediante la función RAND() de la base de datos' 
    ));
  }
  
  public function configureImageFields($name = 'imagen')
  {    
    $this->widgetSchema[$name] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Imagen',
      'file_src'     => $this->isNew() ? '' : $this->getObject()->getImagePath('peq'),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir esta imagen',
      'with_delete'  => $this->isNew() ? false : ($this->getObject()->hasImage() ? true : false),
      'template'     => $this->isNew() ? '%input%' : ($this->getObject()->hasImage() ? '<div>%input%<br />%delete% %delete_label%<br />%file%</div>' : '%input%'),
    ));
    
    $this->validatorSchema[$name] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
    ), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
    ));
    
    $this->validatorSchema[$name.'_delete'] = new sfValidatorPass();
  }
  
  protected function saveImages($image)
  {
    if(!$image) return false;
    
    $sizes = tdhConfig::getImageSorteoSizes();
  
    foreach($sizes as $name => $size)
    {
      $myImage = new ehUtilesImagen($image->getTempName());
  
      $myImage
        ->setFormatoSalida(ehUtilesImagen::FORMATO_JPG)
        ->setModoRedimension(isset($size['ajuste']) ? $size['ajuste'] : ehUtilesImagen::AJUSTE_ADAPTATIVO)
        ->setFicheroDestino(sfConfig::get('sf_web_dir').$this->getObject()->getImagePath($name))
        ->setMaxAlto($size['y'])
        ->setMaxAncho($size['x'])
        ->save();
    }
  }
  
  protected function deleteImages()
  {
    $sizes = tdhConfig::getImageSorteoSizes();
  
    foreach($sizes as $name => $size)
    {
      @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getImagePath($name));
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
    
    // Grabamos las imágenes 
    $this->saveImages($imagen);
  }
}
