<?php

/**
 * tdhConsulta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class tdhConsulta extends BasetdhConsulta
{
  public function postInsert($event)
  {
    $this->setCodigo(hash('crc32b', $this->getId().$this->getCreatedAt()))->save();
  }
}