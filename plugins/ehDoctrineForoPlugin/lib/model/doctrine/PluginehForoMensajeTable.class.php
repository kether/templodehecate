<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginehForoMensajeTable extends Doctrine_Table
{
  static function setQueryAutorizados(Doctrine_Query $q)
  {
    $q->addWhere('m.estado_activo = ?', true)
      ->addWhere("m.visible_desde <= ?", date('Y-m-d H:i:s'));
  }
  
  static function setQueryJoin(Doctrine_Query $q)
  {
    $q->leftJoin("m.Usuario u")
      ->leftJoin("u.UsuarioActivo ua")
      ->leftJoin("u.Perfil p");
  }
  
  public function countPorUsuarioId($usuarioId)
  {
    return $this->createQuery()->where('usuario_id = ?', $usuarioId)->addWhere('hilo_id IS NOT NULL')->count();
  }
  
  public function countPorTablonId($tablonId)
  {
    return $this->createQuery('m')->innerJoin('m.Hilo h')->where('h.tablon_id = ?', $tablonId)->addWhere('m.id != h.primer_mensaje_id')->count();
  }
  
  public function autorizados()
  {
    $q = $this->createQuery('m');
    
    self::setQueryJoin($q);
    self::setQueryAutorizados($q);
    
    return $q;
  }
  
  public function retrieveAutorizadoPorId($id, $userId = null)
  {
    $q = $this
      ->autorizados()
      ->select('m.*, pm.asunto, h.id, t.id, t.nombre, u.*, p.*, ua.*')
      ->innerJoin('m.Hilo h')
      ->innerJoin('h.Tablon t')
      ->innerJoin('h.PrimerMensaje pm')
      ->where('m.id = ?', $id);
    
    return $q->fetchOne();
  }
}