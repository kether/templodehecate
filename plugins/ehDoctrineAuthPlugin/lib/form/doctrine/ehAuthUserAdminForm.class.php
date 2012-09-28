<?php

/**
 * ehAuthUserAdminForm form
 *
 * @package    ehAuthPlugin
 * @subpackage form
 */
class ehAuthUserAdminForm extends BaseehAuthUserForm
{
	public function setup()
  {
    parent::setup();
    
    $this->widgetSchema['credentials_list']->setLabel('Permissions');
    
    $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(), array('autocomplete' => 'off'));
    $this->validatorSchema['password']->setOption('required', false);
    $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];
    
    $this->validatorSchema['username'] = new ehAuthValidatorUserTypo();
    
    $this->widgetSchema->moveField('password_again', 'after', 'password');
    
    $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));
    
    /**
     * @var object ehAuthSecurityUser
     */
    $user = $this->getOption('user', sfContext::getInstance()->getUser());
    
    $this->useFields(array(
      'is_active',
      'username',
      'password',
      'password_again',
      'is_super_admin',
      'credentials_list'
    ));
    
    // Si no es un super administrador no puede modificar el campo de superadministrador ni tampoco puede modificar las credenciales
    if(!$user->hasCredential('superadministrator'))
    {
    	unset($this['is_super_admin']);
    	if(!$user->hasCredential(array('administrator', 'administrador'), false))
    	{
    		unset($this['credentials_list']);
    	}
    }
    
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('eh_auth_plugin');    
  }
}
