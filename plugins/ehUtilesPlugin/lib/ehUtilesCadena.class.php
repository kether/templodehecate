<?php

/*
 * Proyecto ehUtilesPlugin
 * (c) 2009 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * Serie de métodos estáticos de tratamiento de cadenas.  
 * 
 * @package     ehUtilesPlugin
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 */
class ehUtilesCadena
{
  static function cadenaParaURL($text)
  {
    // Reemplazar caracteres que no son ni números ni digitos por "-"
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
   
    // Trim los bordes
    $text = trim($text, '-');
   
    // Transliteral
    if (function_exists('iconv'))
    {
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }
   
    // Sólo diminutivas
    $text = strtolower($text);
   
    // Suprimir caracteres no deseados
    $text = preg_replace('~[^-\w]+~', '', $text);
   
    if (empty($text))
    {
      return 'n-a';
    }
   
    return $text;
  }
  
  static function truncar($string, $length = 80, $etc = '...', $breakWords = false, $middle = false)
  {
	  if ($length == 0)
	      return '';
	
	  if (strlen($string) > $length)
	  {
	      $length -= min($length, strlen($etc));
	      if (!$breakWords && !$middle)
	      {
	          $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
	      }
	      if(!$middle)
	      {
	          return substr($string, 0, $length) . $etc;
	      }
	      else
	      {
	          return substr($string, 0, $length/2) . $etc . substr($string, -$length/2);
	      }
	  }
	  else
	  {
	      return $string;
	  }
  }
  
  /**
   * Extrae de una URL el código identificativo de la plataformas de vídeos soportadas en el método.
   * 
   * Plataformas:
   *   YouTube
   * 
   * @param string $url Cadena URL con el código de la plataforma de vídeo
   * @param string $plataforma
   * @return string
   */
  static function codigoPlataformaVideo($url, $plataforma = null)
  {
    if(preg_match('/youtube\.com\/watch\?v=(.*)/', $url, $matches))
    {
      $url = $matches[1];
    }
    
    return $url;
  }
  
  /**
   * Introduce una cadena en la posición indicada de otra cadena.
   * 
   * @param string $cadena Cadena a insertar
   * @param string $insertada Cadena dónde se insertara la $cadena
   * @param integer $offset Posición dónde se insertará la $cadena en $insertada
   * @return string Cadena resultado
   */
  static function insertarCadena($cadena, $insertada, $offset = 0)
  {  
    return substr($insertada, 0, $offset) . $cadena . substr($insertada, $offset);
  }
  
  static function formatearTextoMarkdownAHTML($texto)
  {
    if(!function_exists('Markdown'))
      include_once(dirname(__FILE__).'/../lib/vendor/markdown/markdown.php');
      
    return Markdown($texto);
  }
  
  static function formatearTextoMarkdownExtraAHTML($texto)
  {
    if(!function_exists('Markdown'))
      include_once(dirname(__FILE__).'/../lib/vendor/markdown/markdown_extra.php');
      
    return Markdown($texto);
  }
  
  static function formatearTextoBBCodeAHTML($texto, $emoticonos = true)
  {
    include_once(dirname(__FILE__).'/../lib/vendor/nbbc/nbbc.php');
    $bbcode = new BBCode;
    
    // Cargamos los ficheros de configuración apropiados (config/bbcode.yml)
    $config = sfToolkit::arrayDeepMerge(
      sfYaml::load(sfConfig::get('sf_config_dir').'/bbcode.yml'),
      sfToolkit::arrayDeepMerge(
        sfYaml::load(sfConfig::get('sf_app_config_dir').'/bbcode.yml'),
        sfYaml::load(dirname(__FILE__).'/../config/bbcode.yml')));
        
    if(isset($config['rules']))
    {
      foreach($config['rules'] as $rule)
      {
        $bbcode->AddRule($rule['name'], $rule['params']);
      }
    }
    
    $bbcode->SetEnableSmileys($emoticonos);
    $bbcode->SetSmileyURL(sfConfig::get('app_eh_utiles_plugin_smileys_url', '/images/smileys'));
    
    return $bbcode->Parse($texto);
  }
  
  static function formatearYoutubeBBCAHTML($bbcode, $action, $name, $default, $params, $content)
  {
    if ($action == BBCODE_CHECK)
    {
      return true;
    }
    
    preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $content, $match);
    return sprintf('<iframe class="video youtube" src="http://www.youtube.com/embed/%s?rel=0" frameborder="0" allowfullscreen="allowfullscreen"></iframe>', $match[1]);
  }
  
  /**
   * Comprueba si una cadena email es válida.
   * 
   * @author Douglas Lovell http://www.linuxjournal.com/article/9585?page=0,0
   * @param string $email
   */
  static function validarEmail($email)
  {
    $isValid = true;
    $atIndex = strrpos($email, "@");
    
    if (is_bool($atIndex) && !$atIndex)
    {
      $isValid = false;
    }
    else
    {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
        // local part length exceeded
        $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
        // domain part length exceeded
        $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
        // local part starts or ends with '.'
        $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
        // local part has two consecutive dots
        $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
        // character not valid in domain part
        $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
        // domain part has two consecutive dots
        $isValid = false;
      }
      else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
      {
        // character not valid in local part unless
        // local part is quoted
        if (!preg_match('/^"(\\\\"|[^"])+"$/',
            str_replace("\\\\","",$local)))
        {
          $isValid = false;
        }
      }
    
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
        // domain not found in DNS
        $isValid = false;
      }
    }
    
    return $isValid;
  }
}