<?php

/**
 * PluginehForoHilo form.
 *
 * @package    form
 * @subpackage ehForoHilo
 */
abstract class PluginehForoHiloForm extends BaseehForoHiloForm
{
  public function configure()
  {
    unset(
      $this['primer_mensaje_id'],
      $this['ultimo_mensaje_id'],
      $this['leido'],
      $this['respuestas']
    );
    
    
    $this->getWidgetSchema()->setLabels(array(
      'estado_oculto'   => '¿Oculto?',
      'estado_cerrado'  => '¿Bloqueado?',
      'estado_pinchado' => '¿Post-it?',
      'estado_general'  => '¿General?',
      'estado_seccion'  => '¿Sección?',
      'tablon_id'       => 'Tablón'
    ));
    
    
    $this->getWidgetSchema()->setFormFormatterName('list');
  }
}