<?php

/**
 * PluginehForoAmigoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginehForoAmigoTable extends Doctrine_Table
{
  /**
   * Returns an instance of this class.
   *
   * @return object PluginehForoAmigoTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('PluginehForoAmigo');
  }
  
  public function encontrarAmistad($invitanteId, $invitadoId)
  {
    return $this
      ->createQuery('a')
      ->addWhere('a.invitante_id = ? AND a.invitado_id = ?', array($invitanteId, $invitadoId))
      ->fetchOne();
  }
}