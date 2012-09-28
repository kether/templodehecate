<?php

class ehUtilesMarkupToHtmlListener extends Doctrine_Record_Listener
{
  protected $_options = array();
  
  public function __construct(array $options)
  {
    $this->_options = $options;
  }
  
  public function preSave(Doctrine_Event $event)
  {
    $field = $event->getInvoker()->getTable()->getFieldName($this->_options['field']);
    
    $modifiedFields = $event->getInvoker()->getModified();
    
    if($event->getInvoker()->$field && isset($modifiedFields[$field]))
    {
      $cadena = new ehUtilesCadenaRica($event->getInvoker()->$field);
      
      if($this->_options['byMethods'])
      {
        $bbcode     = $this->_options['methods']['bbcode'] ? $event->getInvoker()->getTable()->getFieldName($this->_options['methods']['bbcode']) : false;
        $html       = $this->_options['methods']['html'] ? $event->getInvoker()->getTable()->getFieldName($this->_options['methods']['html']) : false;
        $nl2br      = $this->_options['methods']['nl2br'] ? $event->getInvoker()->getTable()->getFieldName($this->_options['methods']['nl2br']) : false;
        $markdown   = $this->_options['methods']['markdown'] ? $event->getInvoker()->getTable()->getFieldName($this->_options['methods']['markdown']) : false;
        $emoticonos = $this->_options['methods']['emoticons'] ? $event->getInvoker()->getTable()->getFieldName($this->_options['methods']['emoticons']) : false;
        $markdownExtra = $this->_options['methods']['markdown_extra'] ? $event->getInvoker()->getTable()->getFieldName($this->_options['methods']['markdown_extra']) : false;
        
        $cadena ->setBBcode(is_string($bbcode) ? $event->getInvoker()->$bbcode : $bbcode)
                ->setHTML(is_string($html) ? $event->getInvoker()->$html : $html)
                ->setMarkdown(is_string($markdown) ? $event->getInvoker()->$markdown : $markdown)
                ->setMarkdownExtra(is_string($markdownExtra) ? $event->getInvoker()->$markdownExtra : $markdownExtra)
                ->setNL2BR(is_string($nl2br) ? $event->getInvoker()->$nl2br : $nl2br)
                ->setEmoticonos(is_string($emoticonos) ? $event->getInvoker()->$emoticonos : $emoticonos);  
      }
      else
      {
        $cadena ->setBBcode($this->_options['parsers']['bbcode'])
                ->setHTML($this->_options['parsers']['html'])
                ->setMarkdown($this->_options['parsers']['markdown'])
                ->setMarkdownExtra($this->_options['parsers']['markdown_extra'])
                ->setNL2BR($this->_options['parsers']['nl2br'])
                ->setEmoticonos($this->_options['parsers']['emoticons']);  
      }
      
      $target = $event->getInvoker()->getTable()->getFieldName($this->_options['target']);
      $event->getInvoker()->$target = $cadena->getCadenaParseada();
    }
  }
}