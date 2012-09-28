<?php

/**
 * PluginehForoTablon form.
 *
 * @package    form
 * @subpackage ehForoTablon
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class PluginehForoTablonForm extends BaseehForoTablonForm
{  
  public function setup()
  {
    parent::setup();
    
    $this->useFields(array(
      'estado_oculto',
      'estado_restringido_hilos',
      'estado_restringido_respuestas',
      'nombre',
      'descripcion',
      'seccion_id',
      'tablon_id',
      'ordinal',
      'visibles_list'
    ));
    
    $this->setWidget('visibles_list', new ehAuthWidgetFormUserText(array('label' => 'Visibles')));
    $this->setValidator('visibles_list', new ehAuthValidatorUsersText(array('multiple' => true, 'column' => 'username', 'model' => 'ehAuthUser', 'required' => false)));
    
    $this->setWidget('tablon_id', new sfWidgetFormChoice(array('choices' => Doctrine::getTable('ehForoTablon')->retrieveArrayFormList())));
    $this->setWidget('descripcion', new sfWidgetFormTextarea());
    
    // Imagen
    $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Icono',
      'file_src'     => $this->getObject()->getUriIcon(),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir este icono',
      'with_delete'  => $this->getObject()->getUriIcon() ? true : false,
      'template'     => $this->getObject()->getUriIcon() ? '<div>%input%</div><div class="tdh_image_form">%delete% %delete_label%<br />%file%</div>' : '%input%',
    ));
    
    $this->validatorSchema['image'] = new sfValidatorFile(array('required' => false, 'mime_types' => 'web_images'), array('mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'));
    $this->validatorSchema['image_delete'] = new sfValidatorPass();
    
    $this->getWidgetSchema()->setLabels(array(
      'estado_oculto' => '¿Oculto?',
      'estado_restringido_hilos' => '¿Temas restringidos?',
      'estado_restringido_respuestas' => '¿Respuestas restringidas?',
      'descripcion' => 'Descripción',
      'seccion_id' => 'Sección',
      'tablon_id' => 'Tablón padre',
      'ordinal' => 'Orden'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
      'estado_restringido_hilos' => 'No se podrán añadir nuevos temas.',
      'estado_restringido_respuestas' => 'No se podrá responder a los temas.'
    ));
  }
  
  public function doSave($con = null)
  {
    $image = $this->getValue('image');
    unset($this['image']);
    
    if($this->getValue('image_delete') == true)
    {
      $this->deleteIcon();
    }
    
    parent::doSave($con);
      
    // Grabamos el icono del tablón
    if($image) $this->saveIcon($image);
  }
  
  public function saveIcon($image)
  {
    $dims = ehForoConfig::getStatic('dims_icon_forum', array());
    $myImage = new ehUtilesImagen($image->getTempName());
    
    $src = ehForoConfig::getStatic('iconos_src').'/'.$this->getObject()->getSlug().'.png';
    
    $myImage
      ->setFormatoSalida(ehUtilesImagen::FORMATO_PNG)
      ->setModoRedimension(ehUtilesImagen::AJUSTE_ADAPTATIVO)
      ->setFicheroDestino(sfConfig::get('sf_web_dir').$src)
      ->setMaxAlto($dims['y'])
      ->setMaxAncho($dims['x'])
      ->save();
    
    $this->getObject()->setUriIcon($src)->save();
  }
  
  public function deleteIcon()
  {
    if($this->getObject()->getUriIcon())
    {
      @unlink(sfConfig::get('sf_web_dir').$src);
      $this->getObject()->setUriIcon('')->save();
    }
  }
}