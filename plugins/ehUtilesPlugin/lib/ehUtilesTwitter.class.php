<?php

/*
 * Proyecto ehUtilesPlugin
 * (c) 2011 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * Permite enviar y recibir datos de Twitter.
 * 
 * @package     ehUtilesPlugin
 * @subpackage  ehUtilesTwitter
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 * @version     v0.3
 */
class ehUtilesTwitter  
{
  const TWITTER_NAMESPACE = 'eh_utiles_twns';
  
  /**
   * @var TwitterOAuth
   */
  protected $classVendor;
    
  /** 
   * @var array
   */
  protected $config = array();

  public function __construct($config = array())
  {
    $this->config = array(
      'consumer_key' => isset($config['consumer_key']) ? $config['consumer_key'] : sfConfig::get('app_eh_utiles_plugin_tw_consumer_key'), 
      'consumer_secret' => isset($config['consumer_secret']) ? $config['consumer_secret'] : sfConfig::get('app_eh_utiles_plugin_tw_consumer_secret'), 
      'access_token' => isset($config['access_token']) ? $config['access_token'] : sfConfig::get('app_eh_utiles_plugin_tw_access_token'),
      'access_token_secret' => isset($config['access_token_secret']) ? $config['access_token_secret'] : sfConfig::get('app_eh_utiles_plugin_tw_access_token_secret'),
      'context' => isset($config['context']) ? $config['context'] : null
    );
    
    // $consumerKey, $consumerSecret, $accessToken, $accessTokenSecret
    $this->classVendor = new TwitterOAuth(
      $this->config['consumer_key'],
      $this->config['consumer_secret'],
      $this->config['access_token'],
      $this->config['access_token_secret']
    );
  }
  
  /**
   * @return sfContext
   */
  public function getContext()
  {
    return $this->config['context'] ? $this->config['context'] : ($this->config['context'] = sfContext::getInstance());
  }
  
  /**
   * @return ehAuthSecurityUser
   */
  public function getUser()
  {
    return $this->getContext()->getUser();
  }
  
  /**
   * @return sfRequest
   */
  public function getRequest()
  {
    return $this->getContext()->getRequest();
  }
  
  /**
   * Devuelve el objeto del vendor tal cual.
   * 
   * @return TwitterOAuth
   */
  public function getClassVendor()
  {
    return $this->classVendor;
  }
  
  public function getAuthLink($callback = '', $signInWithTwitter = true)
  {
    $this->getUser()->getAttributeHolder()->removeNamespace(self::TWITTER_NAMESPACE);
    
    $twitter = new TwitterOAuth($this->config['consumer_key'], $this->config['consumer_secret']);
    $tokens = $twitter->getRequestToken($callback);
    
    $this->getUser()->setAttribute('tw_request_token', $tokens['oauth_token'], self::TWITTER_NAMESPACE);
    $this->getUser()->setAttribute('tw_request_token_secret', $tokens['oauth_token_secret'], self::TWITTER_NAMESPACE);
    
    return $twitter->getAuthorizeURL($tokens['oauth_token'], $signInWithTwitter);
  }
  
  public function doAuthenticate($options = array())
  {
    if($this->getRequest()->getParameter('oauth_token') != $this->getUser()->getAttribute('tw_request_token', '', self::TWITTER_NAMESPACE))
    {
      $this->getContext()->getLogger()->err('El token de autentificación oauth_token "'.$this->getRequest()->getParameter('oauth_token').'" no es igual que el atributo tw_request_token "'.$this->getUser()->getAttribute('tw_request_token', '', self::TWITTER_NAMESPACE).'".');
      return false;
    }
    
    $twitter = new TwitterOAuth(
        $this->config['consumer_key'],
        $this->config['consumer_secret'],
        $this->getUser()->getAttribute('tw_request_token', '', self::TWITTER_NAMESPACE),
        $this->getUser()->getAttribute('tw_request_token_secret', '', self::TWITTER_NAMESPACE)
    );
    
    if(!($data = $twitter->getAccessToken($this->getRequest()->getParameter('oauth_verifier'))))
    {
      $this->getContext()->getLogger()->err('No devolvió datos en la variable $data.');
      return false;
    }
    
    $this->getUser()->getAttributeHolder()->removeNamespace(self::TWITTER_NAMESPACE);
    
    if(isset($options['reasignar_oauth']) && $options['reasignar_oauth'] == true) 
    {
      $this->classVendor = $twitter;
    }
    
    return $data;
  }
  
  /**
   * Envía un "tweet" a Twitter (máximo número de caracteres, 140)
   *
   * @param string $mensaje
   */
  public function enviar($mensaje)
  {
    return $this->getClassVendor()->post('statuses/update', array('status' => ehUtilesCadena::truncar($mensaje, 140)));
  }
  
  public function seguir($usuario)
  {
    return $this->getClassVendor()->post('friendships/create', array('screen_name' => $usuario));
  }
  
  public function usuario($usuario)
  {
    return $this->coger('users/show', array('screen_name' => $usuario));
  }
  
  /**
   * Coge información genérica mediante get en la API de Twitter.
   * https://dev.twitter.com/docs/api
   * 
   * @param string $url
   * @param array $parameters
   * @see TwitterOAuth::get()
   */
  public function coger($url, $parameters = array())
  {
    return $this->getClassVendor()->get($url, $parameters);
  }
}