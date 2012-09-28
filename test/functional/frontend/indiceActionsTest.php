<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new tdhTestFunctional(new sfBrowser());

$noticia = $browser->getUltimaNoticia();

$browser->
  cargarDatos()->
  
  info('Indice: Indices de contenido y portada')->
  
  // La portada
  get('/')->
  info('Indice.1: Ejecutamos la portada principal')->
  with('request')->begin()->
    isParameter('module', 'indice')->
    isParameter('action', 'portada')->
  end()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('#tdh_menu_principal')->
    checkElement('#tdh_submenu_principal')->
  end()->
  
  // El buscador con un solo resultado
  get('/buscar?q='.urlencode($noticia->getTitular()))->
  info('Indice.2: Buscamos un solo resultado en la base de datos')->
  with('request')->begin()->
    isParameter('module', 'indice')->
    isParameter('action', 'buscar')->
  end()->
  with('response')->begin()->
    isRedirected()->
    // followRedirect()->
    // checkElement('#tdh_noticia h1:contains("'.$noticia->getTitular().'")')->
  end()->
  
  // El buscador nos devuelve a la portada si no especificamos un parámetro "q"
  get('/buscar')->
  info('Indice.3.1: No especificamos "q" en la url')->
  with('response')->isRedirected()->
  get('/buscar?q=')->
  info('Indice.3.1: Si el parametro "q" esta vacio')->
  with('response')->isRedirected()->
    
  // El buscador AJAX
  setHttpHeader('X_REQUESTED_WITH', 'XMLHttpRequest')->
  
  get('/buscar?q='.urlencode($noticia->getTitular()))->
  info('Indice.4: Buscador AJAX')->
  with('response')->begin()->
    isStatusCode(200)->
    //checkElement('div:contains("'.$noticia->getTitular().'")')->
  end()
;
