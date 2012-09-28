<?php

/*
 * Proyecto ehDoctrineAuthPlugin
 * (c) 2008 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * 
 * 
 * 
 * @package     ehAuthPlugin
 * @subpackage  form
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 * @version     ehAuthRegeneratePassword.class.php 01/09/2008 13:47:27
 */
class ehAuthRegeneratePasswordForm extends sfForm
{
  
  public function setup()
  {
    $this->setWidgets(array('username' => new sfWidgetFormInput()));
    
    $this->setValidators(array('username' => new sfValidatorOr(array(new ehAuthValidatorUserTypo(), new sfValidatorEmail())) ));
    
    $this->widgetSchema->setNameFormat('eh_regenerate[%s]');
    
    $this->getWidgetSchema()->setFormFormatterName('list');
  }
  
}