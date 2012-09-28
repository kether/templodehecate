<!DOCTYPE html>
<html lang="<?php echo $sf_user->getCulture() ?>">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <meta name="language" content="<?php echo $sf_user->getCulture() ?>" />
    <title><?php include_slot('title', 'Error') ?> • <?php echo tdhConfig::get('nombre') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <?php include_partial('global/javascript') ?>
    
    <?php use_stylesheet('tdh8_principal.css'); ?>
    <?php use_stylesheet('tdh8_error.css'); ?>
    
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <?php include_component('ehSitebarTemplate', 'bar') ?>
          
    <div id="cabecera"><?php echo link_to(image_tag('logo_principal.png', array('alt' => tdhConfig::get('nombre'))), '@homepage') ?></div>
    
    <div id="cuerpo">
      <h2><?php include_slot('title', 'Error') ?></h2>
      
      <?php echo $sf_content ?>
    </div>
    
    <div id="tdh_pie_contenido">
      <?php $menu = sfConfig::get('app_menu_pie', array()) ?>
      <ul>
        <?php if($sf_user->esColaborador()): ?>
        <!-- Opciones de administrador -->
        <li class="tdh_menu_admin">
          <?php include_slot('menu_administrador', link_to_app('Ir al panel del administrador', 'backend', 'homepage')) ?>
        </li>
        <?php endif ?>
        <?php foreach($menu as $key => $opcion): ?>
        <li class="<?php echo 'tdh_menu_'.$key ?>"><?php echo link_to($opcion['title'], $opcion['route']) ?></li>
        <?php endforeach ?>
      </ul>
    </div>
  </body>
</html>
