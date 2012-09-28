<?php

/**
 * tdhEvento form.
 *
 * @package    form
 * @subpackage tdhEvento
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhEventoForm extends BasetdhEventoForm
{
  public function configure()
  {
    $this->useFields(array(
      'estado_aprobado',
      'fecha_inicio',
    	'fecha_fin',
    	'direccion',
    	'localidad',
    	'region',
    	'pais',
    	'latitud',
    	'longitud',
    ));
    
    //$this->setWidget('fecha_inicio', new sfWidgetFormI18nDate(array('culture' => sfConfig::get('sf_default_culture', 'es'))));
    //$this->setWidget('fecha_fin', new sfWidgetFormI18nDate(array('culture' => sfConfig::get('sf_default_culture', 'es'))));
    
    $this->setWidget('fecha_inicio', new ehWidgetFormJQueryDate(array('image' => '/images/btns/calender.png', 'label' => 'Inicio', 'culture' => sfConfig::get('sf_default_culture'), 'date_widget' => new sfWidgetFormI18nDate(array('culture' => sfConfig::get('sf_default_culture', 'es'))))));
    $this->setWidget('fecha_fin', new ehWidgetFormJQueryDate(array('image' => '/images/btns/calender.png', 'label' => 'Fin', 'culture' => sfConfig::get('sf_default_culture'), 'date_widget' => new sfWidgetFormI18nDate(array('culture' => sfConfig::get('sf_default_culture', 'es'))))));
    $this->setWidget('pais', new sfWidgetFormI18nChoiceCountry(array('culture' => sfConfig::get('sf_default_culture', 'es'))));
    
    $this->setValidator('pais', new sfValidatorI18nChoiceCountry());
    
    $this->setDefault('pais', tdhConfig::get('pais', 'ES'));
    $this->setDefault('fecha_inicio', $this->getOption('fecha_inicio', time()));
    $this->setDefault('fecha_fin', $this->getOption('fecha_fin', $this->getOption('fecha_inicio', time())));
    
    $this->getWidgetSchema()->setLabels(array(
      'estado_aprobado' => '¿Aprobado?',
    	'direccion' => 'Dirección',
    	'region' => 'Región',
    	'pais' => 'País'
    ));
  }
}