<?php

/*
 * Proyecto ehUtilesPlugin
 * (c) 2011 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * Permite enviar mensajes automáticamente al muro de una página de Facebook especificada en app.yml.
 * 
 * Para habilitar una página que sea accesible deberás escribir las dos siguientes URLs en orden sustituyendo MYAPIKEY y THEPAGEID por sus correspondientes claves:
 *  * http://www.facebook.com/login.php?api_key=MYAPIKEY&connect_display=popup&v=1.0&next=http://www.facebook.com/connect/login_success.html&cancel_url=http://www.facebook.com/connect/login_failure.html&fbconnect=true&return_session=true&session_key_only=true&req_perms=read_stream,publish_stream,offline_access
 *  * http://www.facebook.com/connect/prompt_permissions.php?api_key=MYAPIKEY&v=1.0&next=http://www.facebook.com/connect/login_success.html?xxRESULTTOKENxx&display=popup&ext_perm=publish_stream&enable_profile_selector=1&profile_selector_ids=THEPAGEID
 * 
 * @package     ehUtilesPlugin
 * @subpackage  ehUtilesFacebook
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 * @version     v0.2
 */
class ehUtilesFacebook
{
  /**
   * @var array
   */
  protected $config = array();
  
  /**
   * @var Facebook
   */
  protected $classVendor = null;
  
  public function __construct($config = array())
  {
    $this->config = array(
      'appId' => isset($config['app_id']) ? $config['app_id'] : sfConfig::get('app_eh_utiles_plugin_fb_id'),
      'secret' => isset($config['secret']) ? $config['secret'] : sfConfig::get('app_eh_utiles_plugin_fb_secret'),
      'context' => isset($config['context']) ? $config['context'] : null
    );
    
    $this->classVendor = new Facebook(array(
      'appId'   => $this->config['appId'],
      'secret'  => $this->config['secret']
    ));
    
    if(isset($config['access_token']))
    {
      $this->getClassVendor()->setAccessToken($config['access_token']);
    }
  }
  
  /**
   * @return Facebook
   */
  public function getClassVendor()
  {
    return $this->classVendor;
  }
  
  /**
   * @return sfContext
   */
  public function getContext()
  {
    return $this->config['context'] ? $this->config['context'] : ($this->config['context'] = sfContext::getInstance());
  }
  
  /**
   * Devuelve la URL para hacer login o autorizar a la aplicación en Facebook.
   * 
   * @param string $callback URL para el retorno desde Facebook
   */
  public function getAuthLink($callback = '', $scope = 'user_about_me,user_birthday,email,user_website,publish_actions,user_likes')
  {    
    return $this->getClassVendor()->getLoginUrl(array('scope' => $scope, 'redirect_uri' => $callback));
  }
  
  public function doAuthenticate($options = array())
  {
    if(!$this->getContext()->getRequest()->getParameter('code'))
    {
      $this->getContext()->getLogger()->err('El código de autentificación "code" no fue entregado.');
      return false;
    }
        
    $data['token'] = $this->getClassVendor()->getAccessToken();;
    $data['info'] = $this->getClassVendor()->api('/me');
    
    return $data;
  }
  
  /**
   * Comprueba si una ID de una aplicación de Facebook le gusta al usuario.
   * 
   * @param integer $id
   */
  public function isLikeIt($id)
  {
    $likes = $this->getClassVendor()->api("/me/likes/$id");
    
    if(!empty($likes['data']))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function getMe()
  {
    return $this->getClassVendor()->api('/me');
  }
  
  public function publicar($attatchment = array(), $id = null)
  {
    try
    {
      if($id)
      {
        $this->getClassVendor()->api('/'.$id.'/feed', 'post', $attatchment);
        return true;
      }
      else
      {
        $page_info = $this->getClassVendor()->api("/".sfConfig::get('app_eh_utiles_plugin_fb_page_id')."/?fields=access_token");
        
        if(!empty($page_info['access_token']))
        {
          $this->getClassVendor()->setAccessToken($page_info['access_token']);
          $this->getClassVendor()->api('/'.sfConfig::get('app_eh_utiles_plugin_fb_page_id').'/feed', 'post', $attatchment);
          return true;
        }
        else
        {
          $this->getContext()->getLogger()->err('No se obtuvo el token de acceso.');
          return false;
        }
      }
    }
    catch(FacebookApiException $e)
    {
      $this->getContext()->getLogger()->err('Ocurrió un error al usar la API de Facebook: '.$e);
      return false;
    }
    catch(Exception $e)
    {
      $this->getContext()->getLogger()->err('Ocurrió un error desconocido al usar la API de Facebook: '.$e);
      return false;
    }
  }
}