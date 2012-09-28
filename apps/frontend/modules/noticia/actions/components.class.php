<?php

class noticiaComponents extends sfComponents
{
  public function executeMedios(sfWebRequest $request)
  {
    $this->getContext()->getConfiguration()->registerZend();
    
    if($feeds = Doctrine::getTable('tdhFeedExterno')->findAll())
    {
      // Registramos Zend Framework para usar los Feeds
      $this->getContext()->getConfiguration()->registerZend();
      $medios = new ehUtilesFeedMezcla();
      
      foreach($feeds as $feed)
      {
        try
        {
          $medios->addFeed(Zend_Feed_Reader::import($feed->getUrlFeed()));
        }
        catch(Exception $e)
        {
        }
      }
      
      $this->novedades = $medios->getFeedMerged();
    }
    else
    {
      $this->novedades = array();
    }
  }
}
