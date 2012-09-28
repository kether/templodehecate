<?php

/**
 * tdhConfig
 * 
 * Configurador general de GTdHv8.0
 * 
 * @package    templodehecate
 * @author     Pablo Floriano <kether@templodehecate.com>
 */
class tdhConfig
{
  const PREFIX_CONFIG = '';
  
  const VERSION = '8.0.0';
  
  public static $configDefault = array(
    'contenidos_por_pagina'         => 15,
    'contenidos_links_por_pagina'   => 10,
    'limite_ultimas_secciones'			=> 15,
    'img_ad_path'                   => '/uploads/assets/sponsors',
  	'img_news_path'                 => '/uploads/assets/news',
    'img_events_path'               => '/uploads/assets/events',
    'img_section_path'              => '/uploads/assets/sections',
    'img_cover_path'                => '/uploads/assets/covers',
    'img_shot_path'                 => '/uploads/assets/shots',
    'img_draw_path'                 => '/uploads/assets/draws',
    'img_logo_sizex'                => '303',
    'img_logo_sizey'                => '100',
    'pdf_resource_path'             => '/uploads/assets/resources/pdf',
    'epub_resource_path'            => '/uploads/assets/resources/epub',
    'publicidad_slug_iconica'	      => 'iconico',
  	'publicidad_slug_principal'     => 'skyscraper-horizontal',
  	'img_generica_sponsor'          => '/images/assets/sponsor.png',
  	'nombre_boletin'								=> 'Templo de Hécate',
  	'asunto_boletin'								=> 'Boletín de Templo de Hécate',
    'version'                       => self::VERSION
  );
  
  public static $tamanosSection = array(
    'defecto' => array('prefijo' => '', 'x' => 430, 'y' => 150),
    'thumb'   => array('prefijo' => 'thumb-', 'x' => 138, 'y' => 48),
    'icon'    => array('prefijo' => 'icon-', 'x' => 40, 'y' => 40),
  );
  
  public static $tamanosSorteo = array(
    'gra' => array('prefijo' => 'l-', 'x' => 930, 'y' => 200),
    'med' => array('prefijo' => 'm-', 'x' => 430, 'y' => 150),
    'peq' => array('prefijo' => 's-', 'x' => 138, 'y' => 48),
  );
  
  public static function get($var, $default = null)
  {
    return sfConfig::get('app_'.self::PREFIX_CONFIG.$var, isset(self::$configDefault[$var]) ? self::$configDefault[$var] : $default);
  }
  
  public static function getImageSectionSizes($name = null)
  {
    $sizes = self::get('img_section_sizes', self::$tamanosSection);
    
    return is_null($name) ? $sizes : $sizes[$name];
  }
  
  public static function getImageSorteoSizes($name = null)
  {
    $sizes = self::get('img_sorteo_sizes', self::$tamanosSorteo);
    
    return is_null($name) ? $sizes : $sizes[$name];
  }
  
  /**
   * @param string $net Cadena vacía o con la palabra 'facebook'|'twitter' ¡NO IMPLEMENTADO AUN!
   * @return boolean
   */
  public static function haveSocial($net = '')
  {
    $entornos = self::get('entornos_sociales');
    return !empty($entornos);
  }
  
  /**
   * @see ehForoConfig::haveReCaptcha()
   * @return boolean
   */
  public static function haveReCaptcha()
  {
    return ehForoConfig::haveReCaptcha();
  }
}
