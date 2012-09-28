<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new tdhTestFunctional(new sfBrowser());

$browser->
  cargarDatos()->
  info('CSS: Hojas de estilo personalizadas')->
  get('/css/personales/mago.css')->

  with('request')->begin()->
    isParameter('module', 'hojaDeEstilo')->
    isParameter('action', 'mostrar')->
    isParameter('fichero', 'mago')->
  end()->

  with('response')->begin()->
    //info('CSS.1: El formato de salida es text/css en unicode-8')->
     isHeader('content-type', 'text/css; charset=utf-8')->
     isStatusCode(200)->
  end()->
  
  get('/css/personales/no-existe.css')->
  with('response')->begin()->
    isStatusCode(404)->
  end()
;
