<?php

/**
 * tdhEnvioSocialPendiente form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhEnvioSocialPendienteForm extends BasetdhEnvioSocialPendienteForm
{
  public function configure()
  {
    $this->useFields(array(
      'servicio',
      'nombre',
      'url',
      'descripcion',
      'mensaje',
      'imagen',
      'programado_para'
    ));
    
    $this->setWidget('programado_para', new sfWidgetFormI18nDateTime(array('culture' => sfConfig::get('sf_default_culture'))));
    $this->setValidator('url', new sfValidatorUrl(array('required' => true)));
    
    $this->getWidgetSchema()->setLabels(array(
      'servicio' => 'Red social',
      'descripcion' => 'Descripción',
      'url' => 'URL'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
      'imagen' => 'Ruta URL de la imagen.',
      'programado_para' => 'Fecha y hora (aproximada, depende del caché) cuando se enviará a la red social el mensaje.'
    ));
  }
}
