<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new tdhTestFunctional(new sfBrowser());

$evento = $browser->cargarDatos()->getUltimoEvento();

$browser->  
  info('Eventos: Lista de eventos, agenda y visualizador')->
  
  // Listado de noticias
  get('/eventos')->
  info('Eventos.1: Archivo de eventos')->
  with('request')->begin()->
    isParameter('module', 'agenda')->
    isParameter('action', 'lista')->
    isParameter('pagina', 1)->
  end()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement(sprintf('.tdh_contenido_lista li:first a[href*="/%d/"]', $evento->getId()))->
  end()->
  
  // Ver una noticia
  click($evento->getTitular())->
  info('Eventos.2: Mostramos un evento')->
  with('request')->begin()->
    isParameter('module', 'agenda')->
    isParameter('action', 'evento')->
    isParameter('slug', $evento->getMensaje()->getSlug())->
  end()->
  with('response')->isStatusCode(200)->
  
  // No existe la noticia
  get('/noticia/666666/no-existe.html')->
  info('Eventos.3: Error 404 si el evento no existe')->
  with('response')->isStatusCode(404)
;