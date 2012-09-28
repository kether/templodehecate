<!DOCTYPE html>
<html lang="<?php $sf_user->getCulture() ?>">
  <head>
	  <?php include_http_metas() ?>
	  <?php include_metas() ?>
	  <meta name="language" content="<?php echo $sf_user->getCulture() ?>" />
	  <meta name="viewport" content = "width=device-width, user-scalable=no">
	  <title><?php include_slot('title', sfConfig::get('app_nombre')) ?></title>
	  
	  <?php use_stylesheet('mobile/principal.css')  ?>
	  
	  <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="contenedor">
      <header>
        <div id="launcher"><?php echo link_to(image_tag('mobile/ic_action_launcher.png', array('alt' => 'Logotipo')), '@homepage') ?></div>
        <div id="actions">
          <div id="overflow"><?php echo image_tag('mobile/ic_action_overflow.png', array('alt' => 'Opciones')) ?></div>
        </div>
      </header>
      <section>Página de test para móviles. Volver a la <a href="<?php echo url_for_app('frontend', 'homepage') ?>">página de inicio</a> de escritorio.</section>
      <footer>Footer</footer>
    </div>
  </body>
</html>
