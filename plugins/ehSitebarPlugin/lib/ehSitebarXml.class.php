<?php

class ehSitebarXml extends SimpleXMLElement
{  
  public function getSites()
  {
    return $this->items->site;
  }
  
  /** 
   * @return integer Devuelve el número de items que hay en el archivo.
   */
  public function getNbSites()
  {
    return count($this->items->site);
  }
  
  /** 
   * @return ehSitebarXml Devuelve el primer sitio.
   */
  public function getFirstSite()
  {
    return $this->items->site[0];
  }
}