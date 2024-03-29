<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginehAuthUser extends BaseehAuthUser
{
  protected
    $credentials      = null;
  
  public function __toString()
  {
    return $this->getUsername() ? $this->getUsername() : '';
  }
    
  public function loadCredentials()
  {
    if(!$this->credentials)
    {
      $credentials = $this->getCredentials();
      $this->credentials = array();
      
      foreach($credentials as $credential)
      {
        $this->credentials[$credential->getName()] = $credential;
      }
    }
  }
  
  public function getMyCredentials()
  {
    $this->loadCredentials();
    return $this->credentials;
  }
  
  public function getCredentialNames()
  {
    $this->loadCredentials();
    return array_keys($this->getMyCredentials());
  }
  
  public function hasCredential($name)
  {
    $this->loadCredentials();
    return isset($this->credentials[$name]);
  }
  
  public function addCredentialByName($name, Doctrine_Connection $con = null)
  {
    $credential = Doctrine::getTable('ehAuthCredential')->findOneByName($name);
    if (!$credential)
    {
      throw new Exception(sprintf('La credencial "%s" no existe.', $name));
    }

    $cu = new ehAuthCredentialUser();
    
    $cu->setehAuthUser($this);
    $cu->setehAuthCredential($credential);

    $cu->save($con);
  }
  
  public function setPassword($password)
  {
    if(!$password && 0 == strlen($password)) return;
    
    $this->setSalt(md5(rand(1000,9999).$this->getUsername()));
    return parent::_set('password', md5($this->getSalt().$password));
  }
  
  public function setUsername($username)
  {
    return parent::_set('username', strtolower($username));
  }
  
  public function checkPassword($password)
  {
    return $this->getPassword() == md5($this->getSalt().$password);
  }  
  
  public function save(Doctrine_Connection $con = null)
  {
    if(!$this->getLastLogin())
    {
      $this->setLastLogin(date('Y-m-d H:i:s', time()));
    }
    
    parent::save($con);
  }
}