<?php

class ehForoMarkupToHtmlBehavior extends Doctrine_Template
{
  /**
   * Array de opciones del comportamiendo de MarkupToHtml 
   * 
   * @var array
   */
  protected $_options = array(
    'field'   => 'descripcion',
    'target'  => 'descripcion_html',
    'type'    => 'string',
    'lenght'  => 50000,
    'byMethods' => false,
    'methods' => array(
                  'markdown'  => 'markdown',
                  'nl2br'     => 'nl2br',
                  'bbcode'    => 'bbcode',
                  'html'      => 'html',
                  'emoticons' => 'emoticonos',
                  'markdown_extra' => false),
    'parsers' => array(
                  'markdown'  => true,
                  'nl2br'     => true,
                  'bbcode'    => false,
                  'markdown_extra' => false,
                  'html'      => false,
                  'emoticons' => false ));
  
  public function __construct(array $options = array())
  {
    $this->_options = Doctrine_Lib::arrayDeepMerge($this->_options, $options);
  }
    
  public function setTableDefinition()
  {
    $this->hasColumn($this->_options['field'], $this->_options['type'], $this->_options['lenght'], array('notnull' => true, 'default' => ''));
    $this->hasColumn($this->_options['target'], $this->_options['type'], $this->_options['lenght'], array('notnull' => true, 'default' => ''));
    
    $this->addListener(new ehForoMarkupToHtmlListener($this->_options));
  }
  
}