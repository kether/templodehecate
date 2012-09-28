<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new tdhTestFunctional(new sfBrowser());

$browser->
  cargarDatos()->
  
  info('Usuarios: Gestion de usuarios en el sitio')->
 
  // Loguearse
  get('/usuario/autenticar')->
  info('Usuarios.1.1: Login como administrador')->
  click('entrar', array('eh_auth_login' => array('username' => 'admin', 'password'  => 'admin', 'remember' => true)))->
  followRedirect()->
  
  with('request')->begin()->
    isParameter('module', 'indice')->
    isParameter('action', 'portada')->
    hasCookie(sfConfig::get('app_eh_auth_plugin_remember_cookie_name'))->
  end()->
  
  click('Foros')->
  info('Usuarios.1.2: Se ha creado el usuario activo admin')->
  with('response')->begin()->
    checkElement('#eh_foro_conectados #usuario_admin')->
  end()->
  
  // Desloguearse
  click('Salir')->
  followRedirect()->
  info('Usuarios.2.1: Terminar la sesion')->
  with('response')->begin()->
    checkElement('#tdh_panel_usuario a:contains("Identificarse")')->
  end()->
  
  // Loguearse como usuario inexistente
  get('/usuario/autenticar')->
  info('Usuarios.3.1: Login como usuario inexistente')->
  click('entrar', array('eh_auth_login' => array('username' => 'usuario_falso', 'password'  => 'usuario_falso', 'remember' => true)))->
  with('response')->begin()->
    checkElement('ul.error_list')->
  end();
;

