<!DOCTYPE html>
<html lang="<?php echo $sf_user->getCulture() ?>">
  <head>
    <?php $sf_context->getResponse()->setTitle(sfConfig::get('app_nombre')) ?>
    
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/backend.ico" />
    
    <?php use_javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', 'first') ?>
    <?php use_javascript('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js') ?>
    <?php use_javascript('jqueryui/jquery.ui.datepicker-es.js') ?>
    
    <?php use_stylesheet('reset.css'); ?>
    <?php use_stylesheet('tdh8_panelcontrol.css'); ?>
    
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="tdh_contenedor">
      <div id="tdh_cabecera">
        <div id="tdh_logotipo"><?php echo link_to(image_tag('logo_principal.png', 'alt='.sfConfig::get('app_nombre', 'Aplicación')), '@homepage') ?></div>
      </div>
      
      <div id="tdh_pagina">
        <?php include_component('indice', 'menuPrincipal') ?>
        
        <?php include_partial('global/notificaciones') ?>
        
        <div id="tdh_contenido">
          <?php echo $sf_content ?>
        </div>
        <div class="tdh_fix"></div>
      </div>
      <div id="tdh_pie"><?php include_partial('global/pie') ?></div>
    </div>
  </body>
</html>
