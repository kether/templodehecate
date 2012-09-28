<?php

class ehUtilesFeedMezcla 
{
  protected $feedMerged = array(
    'title'     => 'Feed mezclado de Estudio Hécate',
    'link'      => 'http://www.estudiohecate.com',
    'charset'   => 'UTF-8',
    'entries'   => array()
  );
  
  protected $feeds = array();
  
  public function setTitle($value)
  {
    $this->feedMerged['title'] = $value;
  }
  
  public function setLink($value)
  {
    $this->feedMerged['link'] = $value;
  }
  
  public function setCharset($value)
  {
    $this->feedMerged['charset'] = $value;
  }
  
  public function addFeed($feed)
  {
    $this->feeds[] = $feed;
  }
  
  public function getEntriesAsArray($feed)
  {  
    $entries = array();
      
    foreach ($feed as $entry)
    {      
      if($entry->getDateModified()->toString('U'))
      {
        $entries[] = array (
          'title' => $entry->getTitle(),
          'link' => $entry->getLink(),
          'guid' => $entry->getId(),
          'author' => $feed->getTitle(),
          'lastUpdate' => $entry->getDateModified()->toString('U'),
          'description' => $entry->getDescription(),
          'pubDate' => $entry->getDateModified(),
        );
      }
    }
    
    return $entries;
  }
  
  public function getFeedMerged()
  {    
    // Mezclamos las entradas
    foreach($this->feeds as $key => $feed)
    {
      $this->feedMerged['entries'] = array_merge($this->feedMerged['entries'], $this->getEntriesAsArray($feed));
    }
    
    // Ordenamos las entradas por orden de publicación
    usort($this->feedMerged['entries'], array($this, 'cmpEntries'));
    
    return $this->feedMerged['entries'];
  }
  
  protected function cmpEntries($a, $b)
  {
    $a_time = $a['lastUpdate'];
    $b_time = $b['lastUpdate'];
    
    if ($a_time == $b_time)
    {
      return 0;
    }
    
    return ($a_time > $b_time) ? -1 : 1;
  }
}