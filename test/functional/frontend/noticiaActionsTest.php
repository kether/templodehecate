<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new tdhTestFunctional(new sfBrowser());

$noticia = $browser->cargarDatos()->getUltimaNoticia();

$browser->  
  info('Noticias: Lista de noticias y visualizador')->
  
  // Listado de noticias
  get('/noticias')->
  info('Noticias.1: Lista de noticias generica')->
  with('request')->begin()->
    isParameter('module', 'noticia')->
    isParameter('action', 'lista')->
    isParameter('pagina', 1)->
  end()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement(sprintf('.tdh_contenido_lista li:first a[href*="/%d/"]', $noticia->getId()))->
  end()->
  
  // Ver una noticia
  click($noticia->getTitular())->
  info('Noticias.2: Mostramos una noticia')->
  with('request')->begin()->
    isParameter('module', 'noticia')->
    isParameter('action', 'mostrar')->
    isParameter('slug', $noticia->getMensaje()->getSlug())->
  end()->
  with('response')->isStatusCode(200)->
  
  get('/noticia/666666/no-existe.html')->
  info('Noticias.3: Error 404 si la noticia no existe')->
  with('response')->isStatusCode(404)->
  
  // Ver el listado de noticias de una seccion
  get('/'.$noticia->getSeccion()->getSlug().'/noticias')->
  info('Noticias.4: Listado de noticias de una seccion')->
  with('request')->begin()->
    isParameter('module', 'noticia')->
    isParameter('action', 'lista')->
    isParameter('pagina', 1)->
  end()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement(sprintf('.tdh_contenido_lista li:first a[href*="/%d/"]', $noticia->getId()))->
  end()
;
