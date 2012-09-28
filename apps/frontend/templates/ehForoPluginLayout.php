<!DOCTYPE html>
<html lang="<?php echo $sf_user->getCulture() ?>">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <meta name="language" content="<?php echo $sf_user->getCulture() ?>" />
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
 
    <?php include_partial('global/javascript') ?>
    
    <?php use_stylesheet('tdh8_principal.css'); ?>
    <?php use_stylesheet('tdh8_addonsforo.css'); ?>
    
    <?php use_stylesheet(ehForoConfig::getStatic('css'), 'last') // hoja de estilo ?>
    
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    
    <style type="text/css">
      body { background-image: url('<?php include_slot('fondo', image_path('bakg/principal.png')) ?>'); }
    </style>
  </head>
  <body>
    <?php include_component('ehSitebarTemplate', 'bar') ?>
    
    <div id="tdh_contenedor_principal">
      <div id="tdh_cabecera">
        <div class="tdh_wrapper">
          <div id="tdh_logotipo"><?php echo link_to(image_tag('logo_principal.png', 'alt='.sfConfig::get('app_nombre', 'Aplicación')), '@homepage') ?></div>
        </div>
        
        <div id="tdh_buscador"><?php include_partial('indice/buscadorCabecera') ?></div>
        
        <div id="tdh_panel_usuario"><?php include_partial('usuario/panelCabecera') ?></div>
      </div>
      
      <div id="tdh_solapa_superior"></div>
      
      <div id="tdh_pagina">
        <?php include_component('indice', 'menuPrincipal') ?>
        
        <?php include_partial('global/notificaciones') ?>
          
        <?php if(!include_slot('eh_foro_navegador')): ?>
        <?php include_partial('ehForoTablon/navegador') ?>
        <?php endif ?>
        
        <?php echo $sf_content ?>
        
        <div id="tdh_pagina_pie"></div>
      </div>
      
      <div id="tdh_solapa_inferior"></div>
      
      <?php include_partial('global/pie') ?>
      
    </div>
  </body>
</html>
