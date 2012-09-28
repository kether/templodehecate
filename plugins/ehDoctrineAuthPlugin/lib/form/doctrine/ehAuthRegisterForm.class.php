<?php

/**
 * Proyecto ehDoctrineAuthPlugin
 * (c) 2008 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * Formulario para el registro de nuevos usuarios en ehAuthUser.
 * 
 * @package     ehAuthPlugin
 * @subpackage  form
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 * @version     ehAuthRegisterForm.class.php 28/05/2008 12:19:33
 */
class ehAuthRegisterForm extends PluginehAuthUserForm
{
  public function setup()
  {
    parent::setup();
    
    $this->setWidgets(array(
      'username'    =>    new sfWidgetFormInput(),
      'password'    =>    new sfWidgetFormInputPassword(),
      'password_again'  =>    new sfWidgetFormInputPassword(),
    ));
    
    $this->setValidators(array(
      'username'    =>    new ehAuthValidatorUserTypo(),
      'password'    =>    new sfValidatorString(array('max_length' => 20, 'min_length' => 5)),
      'password_again'  =>    new sfValidatorString(array('max_length' => 20, 'min_length' => 5)),
    ));
    
    $this->widgetSchema->setNameFormat('eh_register[%s]');
    
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
      new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again'),
      new sfValidatorDoctrineUnique(array(
        'model' => 'ehAuthUser',
        'column' => 'username'))
    )));

    $this->getWidgetSchema()->setFormFormatterName('list');
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('eh_auth_plugin');
  }
}