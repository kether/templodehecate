<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex, follow" />
    <meta name="language" content="es" />
    <title><?php echo tdhConfig::get('nombre') ?> • En mantenimiento</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <link rel="stylesheet" type="text/css" media="screen" href="/css/tdh8_principal.css" />
    
    <style type="text/css">
      body { background-image: url('/images/bakg/principal.png'); color: #fff; }
      #cabecera { width: 450px; margin: 30px auto 0 auto; border-bottom: 1px dotted #fff; text-align: center; padding-bottom: 5px; }
      #cuerpo { width: 450px; margin: 15px auto 0 auto; }
      #cuerpo h2 { color: #fff; font: bold 16px Arial; text-align: center; }
      #tdh_pie_contenido { width: 450px; margin: 15px auto 0 auto; float: none; border-top: 1px dotted #fff; }
    </style>
  </head>
  <body>
    
    <div id="cabecera"><img src="/images/logo_principal.png" alt ="<?php echo tdhConfig::get('nombre') ?>" /></div>
    <div id="cuerpo">
      <h2>Estamos haciendo operaciones de mantenimiento, volvemos pronto...</h2>
    </div>
    
    <?php $menu = sfConfig::get('app_menu_pie', array()) ?>
    <div id="tdh_pie_contenido">
      <ul>
        <?php foreach($menu as $key => $opcion): ?>
        <?php if($opcion['toerror']): ?><li class="<?php echo 'tdh_menu_'.$key ?>"><a href="<?php echo $opcion['route'] ?>"><?php echo $opcion['title'] ?></a></li><?php endif?>
        <?php endforeach ?>
      </ul>
    </div>
    
  </body>
</html>