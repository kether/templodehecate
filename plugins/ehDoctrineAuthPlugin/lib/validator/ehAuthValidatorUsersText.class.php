<?php

/**
 * Valida un campo de tipo ehAuthWidgetFormUserText.
 *
 * @package ehDoctrineAuthPlugin
 * @subpackage validator
 * @author Pablo Floriano <p.floriano@estudiohecate.com>
 */
class ehAuthValidatorUsersText extends sfValidatorDoctrineChoice
{
  protected function doClean($value)
  {
    $value = explode("\n", trim($value));
    
    foreach($value as $key => $v)
    {
      $value[$key] = trim($v);
    }
    
    $value = parent::doClean($value);
    
    return Doctrine_Query::create()->from('ehAuthUser u')->select('u.id')->whereIn('u.username', $value)->execute()->toKeyValueArray('id', 'id');
  }
}