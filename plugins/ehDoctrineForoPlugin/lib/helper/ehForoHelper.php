<?php

function link_to_foro_user($nick, $nombreDeUsuario)
{  
  return $nombreDeUsuario ? link_to($nick, '@eh_foro_perfil?username='.$nombreDeUsuario) : $nick;
}

function link_to_foro_nuevo_tema($nombre, $tablonId, $opciones = null)
{
  return link_to($nombre, '@eh_foro_mensaje_nuevo?tablon_id='.$tablonId, $opciones);
}

function link_to_foro_responder_tema($nombre, $hiloId, $opciones = null)
{
  return link_to($nombre, '@eh_foro_mensaje_responder?hilo_id='.$hiloId, $opciones);
}

function link_to_foro_editar_mensaje($nombre, $mensajeId, $opciones = null)
{
  return link_to($nombre, '@eh_foro_mensaje_editar?mensaje_id='.$mensajeId, $opciones);
}

function foro_lista_adjuntos($adjuntos, $opciones = null)
{
  $cad = '';
  if($adjuntos instanceOf Doctrine_Collection)
  {    
    $cad = '<ul>';
    foreach($adjuntos as $adjunto)
    {
      $cad .= '<li>'.link_to($adjunto->getNombreArreglado(), $adjunto->getRouting()).' ('.$adjunto->getNumeroDescargas().' descargas)</li>';
    }
    $cad .= '</ul>';
  }
  return $cad;
}