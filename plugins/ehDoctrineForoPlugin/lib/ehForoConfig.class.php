<?php

class ehForoConfig
{
  const APP_PRE = 'app_eh_foro_plugin_';
  
  static $confStatic = array(
    'nombre'                        => 'ehDoctrineForoPlugin',
    'layout'                        => 'ehForoPluginLayout',
    'theme_path'                    => '/ehDoctrineForoPlugin',			
    'css'                           => '/ehDoctrineForoPlugin/css/ehforo.principal.css',
    'nick_invitado'                 => 'Invitado',
    'user_admin_default'            => 'admin',
    'permiso_markdown_usuarios'     => false,
    'permiso_post_invitados'        => false,
    'permiso_new_thread_invitados'  => false,
    'permiso_cargar_ficheros'       => false,
    'jquery'                        => false,
    'jqueryui'                      => false,
    'uri_autenticar'                => '@eh_foro_autenticar',
    'temas_por_pagina'              => 20,
    'posts_por_pagina'              => 10,
    'links_temas_por_pagina'        => 10,
    'links_posts_por_pagina'        => 10,
    'avatares_dir'                  => '/avatars',
    'avatares_src'                  => '/uploads/avatars',
    'avatar_size_normal'            => 90,
    'avatar_size_mini'              => 50,
    'path_avatar_default'           => '/images/avatar-default.png',
    'path_avatar_mini_default'      => '/images/avatar-mini-default.png',
    'usuario_activo_timeout'        => 300,
    'recaptcha_key_public'          => null,
    'recaptcha_key_private'         => null,
    'recaptcha_theme'               => 'clean',
    'dims_icon_forum'							  => array('x' => 50, 'y' => 50),
    'iconos_src'										=> '/uploads/ehForoPlugin/iconos'
  );
  
  protected $conf;
  
  public function __construct()
  {
    $this->conf = self::getAll();
  }
  
  /**
   * Devuelve el valor del parámetro de configuración.
   * 
   * @param string $parametro El nombre identificador del parámetro de configuración.
   * @return mixed Si existe el parámetro llave en la configuración, devuelve el valor, de lo contrario devuelve null.
   */
  public function get($parametro)
  {
    return isset($this->conf[$parametro]) ? $this->conf[$parametro] : null;
  }
  
  /**
   * Devuelve el valor del parámetro de configuración.
   * 
   * @param string $parametro El nombre identificador del parámetro de configuración.
   * @return mixed Si existe el parámetro llave en la configuración, devuelve el valor, de lo contrario devuelve null.
   */
  static function getStatic($parametro)
  {    
    return sfConfig::get(self::APP_PRE.$parametro, isset(self::$confStatic[$parametro]) ? self::$confStatic[$parametro] : null);
  }
  
  static function permisoCargarFicheros()
  {    
    return self::getStatic('permiso_cargar_ficheros');
  }
  
  static function getAll()
  {
    $conf = array();
    foreach(self::$confStatic as $key => $value)
    {
      $conf[$key] = sfConfig::get(self::APP_PRE.$key, $value); 
    }
    
    return $conf;
  }
  
  static function getDirAvatarsUploaded()
  {
    return sfConfig::get('sf_upload_dir').'/'.self::getStatic('avatares_dir');
  }
  
  static function getSrcAvatarsUploaded()
  {
    return self::getStatic('avatares_src');
  }
  
  /**
   * Comprueba si el usuario tiene permisos para contestar a temas en los tablones.
   * 
   * @return boolean Devuelve true sí el usuario está autenticado o si está permitido postear a invitados
   */
  static function canPost()
  {
    return sfContext::getInstance()->getUser()->isAuthenticated() || self::getStatic('permiso_post_invitados');
  }
  
  /**
   * Comprueba si el usuario tiene permisos para crear nuevos temas en los tablones.
   * 
   * @return boolean Devuelve true sí el usuario está autenticado o si está permitido crear nuevos temas a invitados
   */
  static function canNewThread()
  {
    return sfContext::getInstance()->getUser()->isAuthenticated() || self::getStatic('permiso_new_thread_invitados');
  }
  
  /**
   * Comprueba si hay claves públicas y privadas para utilizar reCaptcha en los formularios. ¡Atención!, se
   * requiere del plugin sfFormExtraPlugin instalado.
   * 
   * @return boolean
   */
  static function haveReCaptcha()
  {
    return !is_null(self::getStatic('recaptcha_key_public')) && !is_null(self::getStatic('recaptcha_key_private'));
  } 
}