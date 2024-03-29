<?php

/**
 * tdhSorteoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class tdhSorteoTable extends Doctrine_Table
{
  /**
   * Returns an instance of this class.
   *
   * @return object tdhSorteoTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('tdhSorteo');
  }
  
  public function retrieveOneBySlug($slug)
  {
    return $this->createQuery('s')->addWhere('s.slug = ?', $slug)->fetchOne();
  }
  
  public function visibles()
  {
    return $this->createQuery('s')->addWhere('s.estado_visible = ?', true);
  }
  
  public function retrievePagerVisibles($pagina = 1, $opciones = array())
  {
    $pager = new sfDoctrinePager('tdhSorteo', 5);
    
    $pager->setPage($pagina);
    $pager->setTableMethod('visibles');
    $pager->getQuery()->addOrderBy('s.created_at ASC');
    $pager->init();
    
    return $pager;
  }
}