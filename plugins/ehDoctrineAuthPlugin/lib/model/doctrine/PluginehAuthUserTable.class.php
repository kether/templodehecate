<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginehAuthUserTable extends Doctrine_Table
{
  public function retrieveByUsername($username, $isActive = true)
  {
    return $this->createQuery('u')
            ->where('u.username = ?', $username)
            ->addWhere('u.is_active = ?', $isActive)
            ->fetchOne();
  }
  
  public function retrieveListByCredential($credential, $isActive = true)
  {
    return $this->createQuery('u')
      ->innerJoin('u.Credentials c WITH c.name = ?', $credential)
      ->where('u.is_active = ?', $isActive)
      ->execute();
  }
  
  public function retrieveListBySuperadministrator($isSuperadministrator = true, $isActive = true)
  {
    return $this->createQuery('u')
      ->where('u.is_super_admin = ?', $isSuperadministrator)
      ->addWhere('u.is_active = ?', $isActive)
      ->execute();
  }
}