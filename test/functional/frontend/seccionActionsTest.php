<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new tdhTestFunctional(new sfBrowser());

$seccion = $browser->getPrimeraSeccion();
$seccionConUrl = $browser->getPrimeraSeccion(true);   // Con una URL personalizada
$seccionSinUrl = $browser->getPrimeraSeccion(false);  // Con una URL por defecto

$browser->
  cargarDatos()->
  
  info('Secciones: Listado de secciones y visualizador')->
  
  // Listado de juegos
  get('/juegos')->
  info('Secciones.1: Listado de juegos')->
  with('request')->begin()->
    isParameter('module', 'seccion')->
    isParameter('action', 'lista')->
    isParameter('tipo', 0)->
  end()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('#tdh_seccion_lista #tdh_lista li:first a[href*="'.$seccionConUrl->getUrl().'"]')->
  end()->

  // Visualizar una sección
  click($seccionSinUrl->getNombre())->
  info('Secciones.2: Visualizador de la seccion '.$seccionSinUrl->getNombre())->
  with('request')->begin()->
    isParameter('module', 'seccion')->
    isParameter('action', 'indice')->
    isParameter('seccion_slug', $seccionSinUrl->getSlug())->
  end()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('#tdh_seccion h1:contains("'.$seccionSinUrl->getNombre().'")')->
  end()->
  
  // Visualizar una sección falsa
  get('/seccion-no-existe')->
  with('response')->isStatusCode(404)
;
