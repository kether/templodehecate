<?php

/*
 * Proyecto ehAuthPlugin
 * (c) 2008 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * @package     ehAuthPlugin
 * @subpackage  validator
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 * @version     ehAuthUserValidator.class.php 12/03/2008 0:36:27
 */


class ehAuthValidatorUser extends sfValidatorBase
{
  
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('username_field', 'username');
    $this->addOption('password_field', 'password');
    $this->addOption('throw_global_error', false);

    $this->setMessage('invalid', 'The username and/or password is invalid.');
  }

  protected function doClean($values)
  {
    $username = isset($values[$this->getOption('username_field')]) ? $values[$this->getOption('username_field')] : '';
    $password = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';

    // ¿El usuario es válido?
    if ($user = Doctrine::getTable('ehAuthUser')->findOneByUsername($username))
    {
      // ¿Contraseña es válida?
      if ($user->checkPassword($password))
      {
        return array_merge($values, array('user' => $user));
      }
    }

    if ($this->getOption('throw_global_error'))
    {
      throw new sfValidatorError($this, 'invalid');
    }

    throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));
  }
  
}
