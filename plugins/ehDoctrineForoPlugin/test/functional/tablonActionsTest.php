<?php

include_once(dirname(__FILE__).'/../bootstrap/functional.php');

$browser = new ehForoTestFunctional(new sfBrowser());

$browser->
  cargarDatos()->
  
  info('1.0: Tablones e indice del foro')->
  
  // Índice
  get($ehforoplugin_url)->
  with('response')->begin()->
    isStatusCode(200)->
  end()
;