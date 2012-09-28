<?php

/*
 * Proyecto ehAuthPlugin
 * (c) 2008 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * @package     ehAuthPlugin
 * @subpackage  validator
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 * @version     ehAuthValidatorUserTypo.class.php 12/03/2008 0:36:27
 */


class ehAuthValidatorUserTypo extends sfValidatorBase
{
  
  public function configure($options = array(), $messages = array())
  {    
    $this->addOption('max_length', 12);
    $this->addOption('min_length', 5);
    $this->addOption('throw_global_error', false);

    $this->setMessage('invalid', 'The username isn\'t valid.');
  }

  protected function doClean($value)
  {
    $validador = new sfValidatorAnd(array(
        new sfValidatorRegex(array(
          'pattern' => '/^([a-zA-Z](?:(?:(?:\w[\.\_]?)*)\w)+)([a-zA-Z0-9])$/'), array('invalid' => 'User pattern is not valid.')),
        new sfValidatorString(array(
          'max_length' => $this->getOption('max_length'),
          'min_length' => $this->getOption('min_length')))));
    
    return $validador->clean($value);
  }
  
}
