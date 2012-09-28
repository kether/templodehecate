<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex, follow" />
    <meta name="language" content="es" />
    <title><?php echo tdhConfig::get('nombre') ?> • Error 500</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <link rel="stylesheet" type="text/css" media="screen" href="/css/tdh8_principal.css" />
    
    <style type="text/css">
      body { background-image: url('/images/bakg/principal.png'); color: #fff; }
      #cabecera { width: 450px; margin: 30px auto 0 auto; border-bottom: 1px dotted #fff; text-align: center; padding-bottom: 5px; }
      #cuerpo { width: 450px; margin: 15px auto 0 auto; color: #fff; }
      #cuerpo h2 { font: bold 16px Arial; text-align: center; }
      #tdh_pie_contenido { width: 450px; margin: 15px auto 0 auto; float: none; border-top: 1px dotted #fff; }
    </style>
  </head>
  <body>
    
    <div id="cabecera"><img src="/images/logo_principal.png" alt ="<?php echo tdhConfig::get('nombre') ?>" /></div>
    <div id="cuerpo">
      <h2>¡Error catastrófico!</h2>
      <p>
        Se ha detectado un error desconocido en la página. Prueba a recargarla, a esperar a entrar o a volver a dónde estábas.
        Si el problema persiste ponte en contacto con los administradores en <a href="<?php echo 'mailto:'.tdhConfig::get('email') ?>"><?php echo tdhConfig::get('email') ?></a>.
      </p>
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