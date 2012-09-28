<?php

class BaseehSitebarTemplateComponents extends sfComponents
{
  protected $config = array(
    'xml'     => 'http://www.estudiohecate.com/sitebar.xml',
    'size'    => 960,
    'tooltip' => false,
    'enabled' => false
  );
  
  public function executeBar()
  {    
    // Si no se especifica que esté activa la barra de Estudio Hécate, no se muestra
    if(sfConfig::get('app_eh_sitebar_plugin_enabled', $this->config['enabled']) == false) return sfView::NONE;
    
    try
    {
      $url = sfConfig::get('app_eh_sitebar_plugin_xml', $this->config['xml']);
      if($this->checkUrl($url))
      {
        $this->sitebar  = simplexml_load_file($url, 'ehSitebarXml');
        $this->size     = sfConfig::get('app_eh_sitebar_plugin_size', $this->config['size']);
        $this->tiptip   = sfConfig::get('app_eh_sitebar_plugin_tooltip', $this->config['tooltip']);
        
        $this->getResponse()->addStylesheet(sfConfig::get('app_eh_sitebar_plugin_css', $this->sitebar->css));
      }
      else
      {
        return sfView::NONE;
      }
    }
    catch(Exception $e)
    {
      return sfView::NONE;
    }
  }
  
  protected function checkUrl($url)
  {
    $hdrs = @get_headers($url);
    return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$hdrs[0]) : false; 
  }
}