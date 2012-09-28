<?php

class tdhSigninForm extends ehAuthSigninForm
{
  public function configure()
  {
    $this->setWidget('servicio', new sfWidgetFormInputHidden(array('default' => $this->getOption('servicio'))));
    $this->setWidget('uid', new sfWidgetFormInputHidden(array('default' => $this->getOption('uid'))));
    $this->setWidget('token', new sfWidgetFormInputHidden(array('default' => $this->getOption('token'))));
    $this->setWidget('token_secret', new sfWidgetFormInputHidden(array('default' => $this->getOption('token_secret'))));
    
    $this->setValidator('servicio', new sfValidatorString(array('required' => false)));
    $this->setValidator('uid', new sfValidatorString(array('required' => false)));
    $this->setValidator('token', new sfValidatorString(array('required' => false)));
    $this->setValidator('token_secret', new sfValidatorString(array('required' => false)));
    
    $this->getWidgetSchema()->setHelp('username', 'Nombre de identificación');
    $this->getWidgetSchema()->setFormFormatterName('templo');
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('eh_auth_plugin');
  }
  
  public function isValid()
  {
    if(parent::isValid())
    {
      if($this->getValue('servicio'))
      {
        if($usuario = Doctrine::getTable('ehAuthUser')->retrieveOneByUidAndService($this->getValue('uid'), $this->getValue('servicio')))
        {          
          $usuario->getAutentificaciones()->getFirst()
            ->setToken($this->getValue('token'))
            ->setTokenSecret($this->getValue('token_secret'))
            ->save();
        }
        else
        {          
          if(!($usuario = Doctrine::getTable('ehAuthUser')->retrieveByUsername($this->getValue('username')))) return false;
          
          $autentificación = new tdhOauth();
          $autentificación
            ->setUsuario($usuario)
            ->setServicio($this->getValue('servicio'))
            ->setUid($this->getValue('uid'))
            ->setToken($this->getValue('token'))
            ->setTokenSecret($this->getValue('token_secret'))
            ->save();
        }
        
        $this->updateProfile($usuario);
      }
      
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function updateProfile(ehAuthUser $usuario)
  {
    switch($this->getValue('servicio'))
    {
      case 'facebook':
        $facebook = new ehUtilesFacebook(array('access_token' => $this->getValue('token')));
        $data = $facebook->getMe();
        $usuario->getPerfil()->setPerfilFacebook($data['link'])->save();
        break;
      case 'twitter':
        $twitter = new ehUtilesTwitter(array('access_token' => $this->getValue('token'), 'access_token_secret' => $this->getValue('token_secret')));
        $data = $twitter->coger('account/verify_credentials');
        $usuario->getPerfil()->setPerfilTwitter($data->screen_name)->save();
        break;
    }
  }
}