<?php use_helper('ehUtilesRutas') ?>
<!DOCTYPE html>
<html lang="<?php echo $sf_user->getCulture() ?>">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="<?php echo $sf_user->getCulture() ?>" />
    <title><?php echo tdhConfig::get('asunto_boletin') ?></title>
    
    <style>
      a { color: #4682b4; text-decoration: none; }
      #contenido { background: #0b1421 url('<?php echo image_path('bakg/principal.png', true) ?>') no-repeat top center; padding: 10px; }
      #cabecera { background: url('<?php echo image_path('logo_principal.png', true) ?>') no-repeat center center; height: 110px; }
      #pie { color: #727272; width: 65%; font: normal 10px Arial; text-align: center; margin: 10px auto 0 auto; }
      
      #cuerpo {
        font: normal 13px Arial;
        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        margin-top: 10px;
      }
    </style>
  </head>
  
  <body>
    <?php // <div id="nota">Si no ves correctamente éste correo electrónico haz click <a href="#">aquí</a>.</div> ?>
    <div id="contenido">
      <div id="cabecera"></div>
      <div id="cuerpo">
        <div id="descripcion"><?php echo $descripcion ?></div>
        <div id="pie">
          <p>Si deseas dejar de recibir los boletines dirígete a tu <?php echo link_to_app('perfil', 'frontend', 'eh_foro_perfil_editar') ?> en la web
          y cambia las propiedades de envío de correo electrónico.</p>
          <p><?php echo date('Y') ?> © <?php echo link_to_app(tdhConfig::get('asunto_boletin'), 'frontend', 'homepage') ?>.</p>
        </div>
      </div>
    </div>
  </body>
</html>