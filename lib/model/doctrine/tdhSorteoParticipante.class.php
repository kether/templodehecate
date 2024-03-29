<?php

/**
 * tdhSorteoParticipante
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 */
class tdhSorteoParticipante extends BasetdhSorteoParticipante
{
  public function __toString()
  {
    return $this->getNombre();
  }
  
  public function preInsert($event)
  {
    $this->setNumero(Doctrine::getTable('tdhSorteoParticipante')->retrieveUltimoNumeroParticipante($this->getSorteoId())+1);
  }
  
  public function postInsert($event)
  {
    $this->getSorteo()->setParticipantesNum($this->getSorteo()->getParticipantesNum()+1)->save();
  }
  

  public function postDelete($event)
  {
    $this->getSorteo()->setParticipantesNum($this->getSorteo()->getParticipantesNum()-1)->save();
  }
}