<?php

/**
 * tdhAsociacion form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhAsociacionForm extends BasetdhAsociacionForm
{
  const APP_SIZES = 'app_sizes_asociaciones';
  
  public function configure()
  {
    $this->setWidget('pais', new sfWidgetFormI18nChoiceCountry(array('culture' => sfConfig::get('sf_default_culture'), 'countries' => sfConfig::get('app_countries', array('ES')))));
    
    $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Imagen',
      'file_src'     => $this->getObject()->getImagePath('med'),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir esta imagen',
      'with_delete'  => $this->getObject()->hasImage('peq') ? true : false,
      'template'     => $this->getObject()->hasImage('peq') ? '<div>%input%</div><div class="tdh_image_form">%delete% %delete_label%<br />%file%</div>' : '%input%',
    ));
    
    $this->validatorSchema['image'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
    ), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
    ));
    
    $this->validatorSchema['image_delete'] = new sfValidatorPass();
    
    $this->getWidgetSchema()->setLabels(array(
      'direccion'	=> 'Dirección', 
      'web' => 'Sitio web', 
      'pais' => 'País',
      'region' => 'Región',
      'descripcion' => 'Descripción'
    ));
  }
  
  public function doSave($con = null)
  {
    $image = $this->getValue('image');
    unset($this['image']);
     
    if($this->getValue('image_delete') == true)
    {
      $this->deleteImages();
    }
  
    parent::doSave();
    if($image) $this->saveImages($image);
  }
  
  protected function deleteImages()
  {
    $sizes = sfConfig::get(self::APP_SIZES, array());
  
    foreach($sizes as $name => $size)
    {
      @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getImagePath($name));
    }
  }
  
  protected function saveImages($image)
  {
    // Y ahora grabamos el fichero en su lugar correspondiente
    $myImage = new ehUtilesImagen($image->getTempName());
  
    $myImage
      ->setFormatoSalida(ehUtilesImagen::FORMATO_PNG)
      ->setModoRedimension(ehUtilesImagen::AJUSTE_ADAPTATIVO);
  
    $sizes = sfConfig::get(self::APP_SIZES, array());
  
    foreach($sizes as $name => $size)
    {
      $myImage
        ->setFicheroDestino(sfConfig::get('sf_web_dir').$this->getObject()->getImagePath($name))
        ->setMaxAlto($size['y'])
        ->setMaxAncho($size['x'])
        ->save();
    }
  }
}
