<?php

class ehForoForeignKeyBackListener extends Doctrine_Record_Listener
{
  protected $_options = array();
  
  public function __construct(array $options)
  {
    $this->_options = $options;
  }
  
  public function postSave(Doctrine_Event $event)
  {
    if($this->_options['fields'])
    {
      $idField = $event->getInvoker()->getTable()->getFieldName($this->_options['id']);
      $idFieldValue = $event->getInvoker()->$idField;
      
      $q = Doctrine_Query::create()
            ->update($event->getInvoker()->getTable()->getClassnameToReturn())
            ->where($this->_options['id'].' = ?', $idFieldValue);
      
      foreach($this->_options['fields'] as $field)
      {
        $fieldName = $event->getInvoker()->getTable()->getFieldName($field);
        
        if(!$event->getInvoker()->$fieldName)
        {
          $q->set($fieldName, $idFieldValue);
          $exec = true;
        }
      }
      
      if(isset($exec)) $q->execute();
    }
  }
}