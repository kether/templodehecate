<?php

/**
 * PluginehForoPerfil form.
 *
 * @package    form
 * @subpackage ehForoPerfil
 */
abstract class PluginehForoPerfilForm extends BaseehForoPerfilForm
{
  public function setup()
  {    
    parent::setup();
    
    $culture = $this->getOption('culture', sfConfig::get('sf_default_culture', 'es'));
    
    $years = range(1920, date('Y', time()));
    
    $this->setWidget('fecha_nacimiento', new sfWidgetFormI18nDate(array('culture' => $culture, 'years' => array_combine($years, $years))));
    $this->setWidget('zona_horaria', new sfWidgetFormI18nChoiceTimezone(array('culture' => $culture)));
    $this->setWidget('pais', new sfWidgetFormI18nChoiceCountry(array('culture' => $culture)));
    $this->setWidget('idioma', new sfWidgetFormI18nChoiceLanguage(array('culture' => $culture)));
    
    $this->setValidator('zona_horaria', new sfValidatorI18nChoiceTimezone(array('required' => true)));
    $this->setValidator('idioma', new sfValidatorI18nChoiceLanguage(array('required' => true)));
    $this->setValidator('pais', new sfValidatorI18nChoiceCountry(array('required' => true)));
    $this->setValidator('web', new sfValidatorUrl(array('required' => false)));
    
    $this->getWidgetSchema()->setLabels(array(
      'pais'              => 'País',
      'nick'              => 'Seudónimo',
      'fecha_nacimiento'  => 'Fecha de nacimiento',
      'email'             => 'Correo electrónico',
      'web'               => 'Sitio web'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
      'nick'          => 'Tu nick o nombre de pila',
      'residencia'    => 'Localidad en la que vives actualmente',
      'email'         => 'Una dirección de correo e-mail válida',
      'web'           => 'Escribe la URL de tu sitio web o blog',
      'firma'         => 'La firma aparecerá al pie de cada mensaje público que se envíe a los foros',
      'zona_horaria'	=> 'Para ajustar el reloj del sitio'
    ));
  }
}