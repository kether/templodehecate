<?php

/*
 * Proyecto ehAuthPlugin
 * (c) 2008 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * 
 * 
 * 
 * @package       ehAuthPlugin
 * @subpackage    user
 * @author        Pablo Floriano <p.floriano@estudiohecate.com>
 * @version       ehAuthSecurityUser.class.php 06/03/2008 21:32:38
 */

class ehAuthSecurityUser extends sfBasicSecurityUser
{
  
  const EXPIRATION_AGE      = 2592000;   // 30 días
  
  const COOKIE_NAME         = 'ehRemember';
  
  const NAMESPACE_AUTH_USER = 'ehAuthSecurityUser';
  
  const USER_ID_ATTRIBUTE   = 'user_id';
  
  const USER_NAME_ATTRIBUTE = 'username';
  
  private $user = null;
  
  protected
    $realIP     = null,
    $agent      = null;
  
  public function __toString()
  {
    return $this->isAuthenticated() ? $this->getUserName() : 'Invitado';
  }
  
  public function getIP()
  {
    if(is_null($this->realIP))
    {
      if($_SERVER)
      {
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
          $this->realIP = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
          $this->realIP = $_SERVER["HTTP_CLIENT_IP"];
        }
        else
        {
          $this->realIP = $_SERVER["REMOTE_ADDR"];
        }
      }
      else
      {
        if(getenv('HTTP_X_FORWARDED_FOR'))
        {
          $this->realIP = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif(getenv('HTTP_CLIENT_IP'))
        {
          $this->realIP = getenv('HTTP_CLIENT_IP');
        }
        else
        {
          $this->realIP = getenv('REMOTE_ADDR');
        }
      }
    }
    
    return $this->realIP;
  }
  
  public function getAgent()
  {
    if(is_null($this->agent))
    {
      $this->agent = new ehAuthUserAgent();
    }
    
    return $this->agent;
  }
  
  /**
   * Devuelve una cadena identificativa con el nombre del navegador usado por el cliente.
   * 
   * @return string
   */
  public function getBrowser()
  {
    return $this->getAgent()->getBrowser();
  }
  
  /**
   * Devuelve una cadena identificativa con el nombre del sistema operativo usado por el cliente.
   * 
   * @return string Nombre identificativo del sistema operativo
   */
  public function getOS()
  {
    return $this->getAgent()->getPlatform();
  }
  
  public function getAuthUser()
  {
    if (!$this->user && $id = $this->getAttribute('user_id', null, self::NAMESPACE_AUTH_USER))
    {
      $this->user = Doctrine::getTable('ehAuthUser')->find($id);

      if (!$this->user)
      {
        $this->logOut();

        throw new sfException('El usuario no se encuentra en la base de datos y se ha terminado la sesión.');
      }
    }

    return $this->user;
  }
  
  /**
   * Autentica en el dominio de la aplicación al usuario dado en el parámetro.
   * 
   * @param mixed $user Un objeto ehUser o una cadena con el username del usuario
   * @param boolean $remember Si se marca true creará una cookie en el lado del cliente para recordar futuras sesiones
   * @param Doctrine_Connection $con Una conexión PropelPDO
   * @return boolean Devuelve true si se ha logueado correctamenet
   */
  public function logIn($user, $remember = false, Doctrine_Connection $con = null)
  {
    
    if(is_string($user))
    {
      if(!($user = Doctrine::getTable('ehAuthUser')->findOneByUsername($user))) return false;
    }
    
    try
    {
      if(!$user->getIsActive()) return false;
    }
    catch(Exception $e)
    {
      return false;
    }
    
    // Autenticarse
    $this->setAuthenticated(true);
    $this->clearCredentials();
    
    $this->setUserId($user->getId());
    $this->setUserName($user->getUsername());
    $this->addCredentials($user->getCredentialNames());
    
    if($user->getIsSuperAdmin())
    {
      $this->addCredential('superadministrator');
    }
    
    // Guardar información último login
    $user->setLastLogin(date('Y-m-d H:i:s'));
    $user->setLastIpAddress($this->getIP());

    // ¿Lo recordamos?
    if ($remember)
    {
      $key = $this->generateRandomKey();
      $expiration_age = sfConfig::get('app_eh_auth_plugin_remember_key_expiration_age', self::EXPIRATION_AGE);
      
      $user->setRememberKey($key);
      
      $remember_cookie = sfConfig::get('app_eh_auth_plugin_remember_cookie_name', self::COOKIE_NAME);
      $domain = sfConfig::get('app_eh_auth_plugin_remember_cookie_domain', '');
      sfContext::getInstance()->getResponse()->setCookie($remember_cookie, $key, time() + $expiration_age, '/', $domain);
    }
    
    $user->save($con);
    
    return true;
  }
  
  public function logOut()
  {
    $remember_cookie = sfConfig::get('app_eh_auth_plugin_remember_cookie_name', self::COOKIE_NAME);
    $domain = sfConfig::get('app_eh_auth_plugin_remember_cookie_domain', '');
    sfContext::getInstance()->getResponse()->setCookie($remember_cookie, 0, time(), '/', $domain);
    
    $this->getAttributeHolder()->removeNamespace(self::NAMESPACE_AUTH_USER);
    $this->user = null;
    $this->clearCredentials();
    $this->setAuthenticated(false);
  }
  
  public function registerNewUser($fields)
  {
    $newuser = new ehUser();
    
    $newuser->setUsername(strtolower($fields['username']));
    $newuser->setPassword($fields['password']);
    $newuser->setIsActive(1);
    
    $newuser->save();
    
    return $newuser;
  }
  
  protected function generateRandomKey($len = 20)
  {
    $string = '';
    $pool   = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    for ($i = 1; $i <= $len; $i++)
    {
      $string .= substr($pool, rand(0, 61), 1);
    }

    return md5($string);
  }
  
  public function generateRandomPassword($len = 8)
  {
    $string = '';
    $pool   = 'abcdefghijklmnopqrstuvwxyz0123456789';
    for ($i = 1; $i <= $len; $i++)
    {
      $string .= substr($pool, mt_rand(0, strlen($pool)-1), 1);
    }
    
    return $string;
  }
  
  public function getAuthCredentials()
  {
    return $this->getAuthUser() ? $this->getAuthUser()->getCredentials() : array();
  }
  
  public function getUserId()
  {
    return $this->getUserAttribute(self::USER_ID_ATTRIBUTE);
  }
  
  public function getUserName()
  {
    return $this->getUserAttribute(self::USER_NAME_ATTRIBUTE);
  }
  
  public function getUserAttribute($nameAttribute, $default = null)
  {
    return $this->getAttribute($nameAttribute, $default, self::NAMESPACE_AUTH_USER);
  }
  
  protected function setUserId($v)
  {
    $this->setUserAttribute(self::USER_ID_ATTRIBUTE, $v);
  }
  
  protected function setUserName($v)
  {
    $this->setUserAttribute(self::USER_NAME_ATTRIBUTE, $v);
  }
  
  public function setUserAttribute($nameAttribute, $valueAttribute)
  {
    $this->setAttribute($nameAttribute, $valueAttribute, self::NAMESPACE_AUTH_USER);
  }
  
  public function removeUserAttribute($nameAttribute)
  {
  	$this->getAttributeHolder()->remove($nameAttribute, self::NAMESPACE_AUTH_USER);
  }
  
  /**
   * Comprueba si es la primera petición y la marca como "falso" si es verdadero tras hacerlo.
   * 
   * @param null|boolean $boolean
   * @return boolean
   */
  public function isFirstRequest($boolean = null)
  {
    if (is_null($boolean))
    {
      $boolean = $this->getUserAttribute('first_request', true);
      $this->setUserAttribute('first_request', false);
      return $boolean;
    }
    else
    {
      $this->setUserAttribute('first_request', $boolean);
      return $boolean;
    }
  }
}