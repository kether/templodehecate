<?php

class ehPaypalField
{
  const TYPE_HIDDEN   = 'hidden';
  
  const TYPE_SELECT   = 'select';
  
  const TYPE_RADIO    = 'radio';
  
  protected $name = null;
  
  protected $default = null;
  
  protected $type = null;
  
  protected $options = array();
  
  protected $widget = null;
  
  public function __construct($name, $default = '', $type = null, $options = array())
  {
    $this->name     = $name;
    $this->default  = $default;
    $this->type     = $type ? $type : self::TYPE_HIDDEN;
    $this->options  = $options;
  }
  
  public function __toString()
  {
    return (string)$this->getDefault();
  }
  
  public function getName()
  {
    return $this->name;
  }
  
  public function getDefault()
  {
    return $this->default;
  }
  
  /**
   * @return sfWidgetForm
   */
  public function getWidget()
  {
    if(!$this->widget)
    {    
      switch($this->type)
      {
        case self::TYPE_HIDDEN:
          $widget = new sfWidgetFormInputHidden(array('default' => $this->getDefault()));
          break;
        case self::TYPE_SELECT:
          $widget = new sfWidgetFormChoice(array('choices' => $this->options, 'default' => $this->getDefault()));
          break;
        case self::TYPE_RADIO:
          $widget = new sfWidgetFormSelectRadio(array('choices' => $this->options, 'default' => $this->getDefault()));
          break;
      }
    
      $this->widget = $widget;
    }
    
    return $this->widget;
  }
  
  public function setLabel($value)
  {
    $this->getWidget()->setLabel($value);
  }
}