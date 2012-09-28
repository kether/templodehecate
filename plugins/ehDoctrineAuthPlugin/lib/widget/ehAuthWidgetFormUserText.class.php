<?php

/**
 * Crea un campo de tipo "textarea" para insertar nombres de usuario (username) línea a línea
 * 
 * @package ehDoctrineAuthPlugin
 * @subpackage widget
 * @author Pablo Floriano <p.floriano@estudiohecate.com>
 */
class ehAuthWidgetFormUserText extends sfWidgetFormTextarea
{
  protected function sacarValores($value)
  {    
    if(is_array($value) && $value)
    {
      $result = Doctrine::getTable('ehAuthUser')
        ->createQuery('u')
        ->select('u.id, u.username')
        ->whereIn('u.id', $value)
        ->execute()
        ->toKeyValueArray('id', 'username');
      
      return self::escapeOnce(implode("\n", $result));
    }
    else
    {
      return self::escapeOnce(is_array($value) ? implode($value) : $value);
    }
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return $this->renderContentTag('textarea', $this->sacarValores($value), array_merge(array('name' => $name), $attributes));
  }
}