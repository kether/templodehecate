<?php

/**
 * Devuelve un vínculo de una imagen con rollover sin necesidad de funciones JavaScript
 * externas aunque no precarga las imágenes (se cargan sólo cuando pasan el cursor por encima)
 *
 * @param string $image_src_out
 * @param string $image_src_over
 * @param string $url_to
 * @param string $alt también añadirá el atributo 'title' al vínculo
 * @return string
 */
function image_link_rollover($image_src_out, $image_src_over, $url_to, $alt = '')
{
  return link_to(image_tag($image_src_out, array(
      'alt'=>$alt,
      'onmouseover'=>"this.src = '".image_path($image_src_over)."'",
      'onmouseout'=>"this.src = '".image_path($image_src_out)."'")), $url_to, array('title' => $alt));
}

function image_link_normal($image_src, $url_to, $alt = '')
{
  return link_to(image_tag($image_src, array('alt' => $alt)), $url_to, array('title' => $alt));
}

function enumerar_lista($lista, $separador = ', ')
{
  $cadena = '';
  
  foreach($lista as $elem)
  {
    $cadena .= trim($elem).$separador;
  }
  
  return substr($cadena,0,strlen($separador)*-1);
}

/**
 * Adatpado de las librerías de Smarty. Trunca una cadena dada según los parámetros de la función
 *
 * @param string $string
 * @param integer $length
 * @param string $etc
 * @param boolean $break_words
 * @param boolean $middle
 * @return string
 */
function cadena_truncada($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
{
  return ehUtilesCadena::truncar($string, $length, $etc, $break_words, $middle);
}