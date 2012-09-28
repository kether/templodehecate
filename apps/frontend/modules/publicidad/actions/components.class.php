<?php

class publicidadComponents extends sfComponents
{  
  /**
   * Leemos el feed de Pokipsi para mostrar en la web los últimos productos
   * 
   * @param sfWebRequest $request
   */
  public function executePokipsi(sfWebRequest $request)
  {
    // Registramos Zend Framework para usar los Feeds
    $this->getContext()->getConfiguration()->registerZend();
    
    // Llamamos al Feed de Pokipsi
    try
    {
      $this->feed = Zend_Feed_Reader::import(sfConfig::get('app_feed_pokipsi'));
    }
    catch(Exception $e)
    {
      $this->feed = array();
    }
  }
  
  public function executePatrocinadores(sfWebRequest $request)
  {
    $this->patrocinadores = Doctrine::getTable('tdhAnuncio')->retrieveListByTipoSlug(tdhConfig::get('publicidad_slug_iconica'));
  }
  
  /**
   * Muestra un banner de publicidad principal.
   * 
   * @param sfWebRequest $request
   */
  public function executeBanner(sfWebRequest $request)
  {
    if($this->getUser()->sinPublicidad())
    {
      return sfView::NONE;
    }
    
    if($this->banner = Doctrine::getTable('tdhAnuncio')->retrieveOneRandByTipoSlug(tdhConfig::get('publicidad_slug_principal')))
    {
      $this->bannerTipo = $this->banner->getTipo(); 
    }
    elseif(!($this->bannerTipo = Doctrine::getTable('tdhAnuncioTipo')->findOneBySlug(tdhConfig::get('publicidad_slug_principal'))))
    {
      return sfView::NONE;
    }
  }
  
  public function executeMisAnuncios()
  {
    if($this->getUser()->isAuthenticated())
    {
      $this->anuncios = Doctrine::getTable('tdhAnuncio')->retriveListByUserId($this->getUser()->getUserId());
      
      if($this->anuncios->count() < 1)
      {
        return sfView::NONE;
      }
    }
    else
    {
      return sfView::NONE;
    }
  }
}
