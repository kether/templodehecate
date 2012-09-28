<?php

/**
 * ehForoPerfil form.
 *
 * @package    form
 * @subpackage ehForoPerfil
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ehForoPerfilForm extends PluginehForoPerfilForm
{
  public function configure()
  {    
    $this->setWidget('sin_publi_hasta', new sfWidgetFormI18nDateTime(array('culture' => sfConfig::get('sf_default_culture', 'es'))));
    
    $this->setValidator('perfil_facebook', new sfValidatorUrl(array('required' => false)));
    $this->setValidator('perfil_gplus', new sfValidatorUrl(array('required' => false)));
    $this->setValidator('perfil_paypal', new sfValidatorEmail(array('required' => false)));
    $this->setValidator('sin_publi_hasta', new sfValidatorDateTime(array('required' => false)));
    
    $this->useFields(array(
    	'nombre',
      'apellidos',
      'nick',
      'sexo',
      'fecha_nacimiento',
      'email',
      'web',
      'residencia',
      'pais',
    	'idioma',
    	'zona_horaria',
     	'perfil_facebook',
    	'perfil_tuenti',
    	'perfil_twitter',
    	'perfil_gplus',
    	'perfil_paypal',
    	'firma',
    	'boletines',
    	'pase_beta',
    	'foro_a_templo',
    	'botones_sociales',
    	'sin_publi',
    	'sin_publi_hasta',
    ));
    
    $this->getWidgetSchema()->setLabels(array(
      'sin_publi'			 => 'Sin publicidad',
    	'sin_publi_hasta'=> 'Sin publicidad hasta',
      'perfil_tuenti'  => 'Tuenti',
      'perfil_facebook'=> 'Facebook',
      'perfil_twitter' => 'Twitter',
      'perfil_gplus'   => 'Google+',
      'perfil_paypal'  => 'PayPal',
      'pase_beta'			 => 'Beta',
      'foro_a_templo'  => 'Redirección canónica'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
    	'pase_beta'     => 'Acceso a los apartados Beta de la web',     
    	'nick'          => 'Tu nick o nombre de pila',
      'residencia'    => 'Localidad en la que vives actualmente',
      'email'         => 'Una dirección de correo e-mail válida',
      'web'           => 'Escribe la URL de tu sitio web o blog',
      'firma'         => 'La firma aparecerá al pie de cada mensaje público que se envíe a los foros',
      'zona_horaria'	=> 'Para ajustar el reloj del sitio',
      'perfil_twitter' => 'Tu identificador de Twitter sin la @',
      'perfil_facebook' => 'URL de tu muro',
      'perfil_gplus'  => 'URL de tu perfil',
      'perfil_paypal' => 'Cuenta PayPal para recibir donaciones',
      'boletines'			=> 'Suscripción al boletín periódico por e-mail',
    	'foro_a_templo' => 'Quiero que me redireccione a la web los temas de contenido'
    ));
  }
}