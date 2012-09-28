<?php

class ehForoForeignKeyBackBehavior extends Doctrine_Template
{
  /**
   * Array de opciones del comportamiendo de ForeignKeyBack 
   * 
   * @var array
   */
  protected $_options = array(
    'id'      => 'id',
    'fields'  => array(),
    'lenght'  => 4,
    'type'    => 'integer'
  );
  
  public function __construct(array $options = array())
  {
    $this->_options = Doctrine_Lib::arrayDeepMerge($this->_options, $options);
  }
    
  public function setUp()
  {
    if($this->_options['fields'])
    {
      foreach($this->_options['fields'] as $field)
      {
        $this->hasColumn($field, $this->_options['type'], $this->_options['lenght']);
        
        $this->hasOne($this->getTable()->getClassnameToReturn(), array(
             'local' => $field,
             'foreign' => $this->_options['id'],
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));
      }
    }
    
    $this->addListener(new ehForoForeignKeyBackListener($this->_options));
  }
  
}