<?php

class ehAuthChangePasswordForm extends BaseehAuthUserForm
{
  public function setup()
  {
    $this->setWidgets(array(
      'password'        => new sfWidgetFormInputPassword(),
      'password_again'  => new sfWidgetFormInputPassword(),
    ));
    
    $this->setValidators(array(
      'password'        => new sfValidatorString(array('max_length' => 20, 'min_length' => 5)),
      'password_again'  => new sfValidatorString(array('max_length' => 20, 'min_length' => 5)),
    ));    
    
    $this->widgetSchema->setNameFormat('eh_change_password[%s]');
    
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
      new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again')
    )));
    
    $this->getWidgetSchema()->setFormFormatterName('list');
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('eh_auth_plugin');
  }
}