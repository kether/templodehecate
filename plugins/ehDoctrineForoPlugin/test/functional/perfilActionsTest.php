<?php

include_once(dirname(__FILE__).'/../bootstrap/functional.php');

$browser = new ehForoTestFunctional(new sfBrowser());

$browser->
  cargarDatos()->
  info('3.0: Perfiles del foro')->
  
  // Crear cuenta
  get($ehforoplugin_url.'/crear-cuenta')->
  info('3.1: Crear una nueva cuenta en los foros')->
  with('response')->isStatusCode(200)->
  borrarPerfilCreado()->
  click('Crear cuenta', array(
    'eh_register' => array(
      'username' => ehForoTestFunctional::CREADO_USERNAME, 
      'password' => ehForoTestFunctional::CREADO_PASSWORD,
      'password_again' => ehForoTestFunctional::CREADO_PASSWORD,
      'Perfil' => array(
        'email' => ehForoTestFunctional::CREADO_EMAIL
      )))
  )->
  // with('response')->debug()->
  followRedirect()->
  with('request')->begin()->
    isParameter('module', 'ehForoPerfil')->
    isParameter('action', 'mostrar')->
    isParameter('username', ehForoTestFunctional::CREADO_USERNAME)->
  end()->
  with('response')->isStatusCode(200)->
  
  // Cambiar contraseña
  click('Cambiar contraseña')->
  info('3.2: Cambiar la clave de '.ehForoTestFunctional::CREADO_USERNAME)->
  with('request')->begin()->
    isParameter('module', 'ehForoPerfil')->
    isParameter('action', 'cambiarClave')->
  end()->
  click('Aceptar contraseña', array(
    'eh_change_password' => array(
      'password' => 'nuevaclave', 
      'password_again' => 'nuevaclave')))->
  followRedirect()->
  with('request')->begin()->
    isParameter('module', 'ehForoPerfil')->
    isParameter('action', 'mostrar')->
    isParameter('username', ehForoTestFunctional::CREADO_USERNAME)->
  end()->
    with('response')->checkElement('#eh_foro_suceso_exito')->
  
  // Regenerar contraseñas
  restart()->
  get($ehforoplugin_url.'/regenerar/clave')->
  info('3.3.1: Regenerar la clave de acceso mediante el username')->
  with('request')->begin()->
    isParameter('module', 'ehForoPerfil')->
    isParameter('action', 'regenerarClave')->
  end()->
  click('Enviar contraseña', array('eh_regenerate' => array('username' => ehForoTestFunctional::CREADO_USERNAME)))->
  with('response')->begin()->
    checkElement('#eh_foro_suceso_exito')->
  end()->
  
  info('3.3.2: Regenerar la clave de acceso mediante la direccion e-mail')->
  click('Enviar contraseña', array('eh_regenerate' => array('username' => ehForoTestFunctional::CREADO_EMAIL)))->
  with('response')->begin()->
    checkElement('#eh_foro_suceso_exito')->
  end()
  //info('3.3.3: El e-mail se envio correctamente')->
  //with('mailer')->begin()->
  //  checkHeader('From', sfConfig::get('app_mailer_desde_nombre', 'EstudioHecate.com') .' <'.sfConfig::get('app_mailer_desde_email', 'noresponder@estudiohecate.com').'>')->
  //end()
;