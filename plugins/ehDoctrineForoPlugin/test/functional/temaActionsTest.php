<?php

include_once(dirname(__FILE__).'/../bootstrap/functional.php');

$browser = new ehForoTestFunctional(new sfBrowser());

$browser->cargarDatos();
$seccion = $browser->getPrimeraSeccion();
$tablon = $browser->getPrimerTablon($seccion->getId());

$browser->

  info('2.0: Temas e hilos')->
  
  // Índice
  get($ehforoplugin_url)->
  click($tablon->getPrimerMensajeByUltimoHilo()->getAsunto())->
  with('response')->begin()->
    isStatusCode(200)->
  end()
;