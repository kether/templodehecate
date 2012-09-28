<?php

/*
 * Proyecto ehUtilesPlugin
 * (c) 2008 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * Permite conseguir una URL corta mediante la API de Goo.gl. 
 * ATENCIÓN: No he conseguido que funcione, no estoy seguro porque, puede que haya que autorizar el dominio web.
 * 
 * @package     ehUtilesPlugin
 * @subpackage  ehUtilesGoogl
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 * @version     v1.0
 */
class ehUtilesGoogl
{
  public $path  = null;
  public $key   = null;
       
  function __construct()
  {
    $this->path = sfConfig::get('app_eh_utiles_plugin_googl_url', 'https://www.googleapis.com/urlshortener/v1');
    $this->key  = sfConfig::get('app_eh_utiles_plugin_googl_key');
  }
  
  /**
   * Acorta una URL mediante la API de goo.gl
   * 
   * @param string $url
   * @return string
   */
  function acortar($url)
  {
    try
    {
      $ch = curl_init($this->path.'/url?key='.$this->key);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('longUrl' => $url)));
      $rpta = curl_exec($ch);
    }
    catch(Exception $e)
    {
      throw new Exception($e);
    }
    
    $data = json_decode($rpta, true);
    curl_close($ch);
    
    return $data["id"];
  }
  
  /**
   * Expande una URL acortada con goo.gl
   * 
   * @param string $url
   * @return string
   */
  function expandir($url)
  {
    $ch = curl_init($this->path."/url?shortUrl=".$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           
    $rpta = curl_exec($ch);
    $data = json_decode($rpta, true);
    curl_close($ch);
           
    return $data["longUrl"];
  }   
}