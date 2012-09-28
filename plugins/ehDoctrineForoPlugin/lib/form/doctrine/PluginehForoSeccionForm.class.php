<?php

/**
 * PluginehForoSeccion form.
 *
 * @package    form
 * @subpackage ehForoSeccion
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class PluginehForoSeccionForm extends BaseehForoSeccionForm
{
  public function setup()
  {
    parent::setup();
    
    $this->useFields(array(
      'estado_oculto',
      'ordinal',
      'nombre',
      'descripcion'
    ));
    
    $this->setWidget('descripcion', new sfWidgetFormTextarea());
    
    $this->getWidgetSchema()->setLabels(array(
      'estado_oculto' => '¿Oculta?',
      'ordinal' => 'Orden',
      'descripcion' => 'Descripción'
    ));
  }
}