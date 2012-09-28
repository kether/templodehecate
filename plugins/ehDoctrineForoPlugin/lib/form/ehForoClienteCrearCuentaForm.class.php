<?php

class ehForoClienteCrearCuentaForm extends ehAuthRegisterForm
{
  public function configure()
  {    
    // Perfil
    
    $perfil = new ehForoPerfilForm($this->getObject()->Perfil);
    
    $perfil->useFields(array(
      'email',
      'sexo'
    ));
    
    $perfil->getWidgetSchema()->setFormFormatterName('foro');
    
    $this->embedForm('Perfil', $perfil);
    
    // Usuario
    
    $this->getWidgetSchema()->setHelps(array(
      'username'    => 'Nombre de entre 5 y 12 caracteres',
      'password'    => 'Clave segura de entre 5 y 20 caracteres'
    ));
    
    // reCaptcha
    if(ehForoConfig::haveReCaptcha())
    {
      $this->widgetSchema['recaptcha']    = new sfWidgetFormReCaptcha(array(
        'public_key'  => ehForoConfig::getStatic('recaptcha_key_public'),
        'label'       => 'reCaptcha', 
        'culture'     => sfConfig::get('sf_default_culture'),
        'theme'       => ehForoConfig::getStatic('recaptcha_theme')
      ));
      $this->validatorSchema['recaptcha'] = new sfValidatorReCaptcha(array('private_key' => ehForoConfig::getStatic('recaptcha_key_private')), array('captcha' => "El 'captcha' no es válido (captcha inválido)."));
      
      $this->getWidgetSchema()->setHelp('recaptcha', 'Escribe las dos palabras que aparecen en el recuadro');
    }
    
    $this->getWidgetSchema()->setFormFormatterName('foro');
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('eh_auth_plugin');
  }
}