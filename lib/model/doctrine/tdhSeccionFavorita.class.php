<?php

/**
 * tdhSeccionFavorita
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class tdhSeccionFavorita extends BasetdhSeccionFavorita
{
  protected function updateFavoritosOfSeccion()
  {
    $favoritos = Doctrine::getTable('tdhSeccionFavorita')->retrieveCountsBySeccionId($this->getSeccionId());
    Doctrine_Query::create()->update('tdhSeccion')->set('favoritos', '?', $favoritos)->addWhere('id = ?', $this->getSeccionId())->execute();
  }
  
  public function postInsert($event)
  {
    $this->updateFavoritosOfSeccion();
  }
  
  public function postDelete($event)
  {
    $this->updateFavoritosOfSeccion();
  }
}