<?php

/*
 * Proyecto ehDoctrineAuthPlugin
 * (c) 2008 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * @package     ehDoctrineAuthPlugin
 * @subpackage  form
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 */

class ehAuthSigninForm extends sfForm
{
  
  public function setup()
  {
    $this->setWidgets(array(
      'username'    =>    new sfWidgetFormInput(),
      'password'    =>    new sfWidgetFormInputPassword(),
      'remember'    =>    new sfWidgetFormInputCheckbox(),
    ));
    
    $this->setValidators(array(
      'username'    =>    new sfValidatorString(),
      'password'    =>    new sfValidatorString(),
      'remember'    =>    new sfValidatorBoolean(),
    ));
    
    $this->validatorSchema->setPostValidator(new ehAuthValidatorUser());
    
    $this->widgetSchema->setNameFormat('eh_auth_login[%s]');

    // $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->getWidgetSchema()->setFormFormatterName('list');
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('eh_auth_plugin');
    
    parent::setup();
  }
  
}