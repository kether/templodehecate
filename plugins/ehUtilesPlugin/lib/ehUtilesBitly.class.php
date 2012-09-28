<?php

/*
 * Proyecto ehUtilesPlugin
 * (c) 2008 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * Permite conseguir una URL corta mediante la API de Bit.ly
 * 
 * @package     ehUtilesPlugin
 * @subpackage  ehUtilesBitly
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 * @version     v1.0
 */
class ehUtilesBitly
{
  protected $path;
  protected $user;
  protected $key;

  function __construct()
  {
    $this->path   = sfConfig::get('app_eh_utiles_plugin_bitly_path', 'http://api.bit.ly/v3/'); //http://api.bit.ly/v3/
    $this->user   = sfConfig::get('app_eh_utiles_plugin_bitly_user');
    $this->key    = sfConfig::get('app_eh_utiles_plugin_bitly_key');
  }

  function acortar($url)
  {
    $temp = $this->path."shorten?login=".$this->user."&apiKey=".$this->key."&uri=".$url."&format=txt";
    $data = file_get_contents($temp);
    return $data;
  }
        
  function expandir($url)
  {
    $temp = $this->path."expand?login=".$this->user."&apiKey=".$this->key."&shortUrl=".$url."&format=txt";
    $data = file_get_contents($temp);
    return $data;
  }   
}