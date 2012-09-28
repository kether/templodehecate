<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title>Templo de Hécate 8.0 beta</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <?php include_partial('global/javascript') ?>
    
    <?php use_stylesheet('tdh8_principal.css'); ?>
    <?php use_stylesheet('tdh8_formularios', 'last') ?>
      
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    
    <script type="text/javascript">
      $(function(){
        $(".tdh_submit input[type=submit]").button();
      });
    </script>
    
    <style type="text/css">
      body { background-image: url('<?php echo image_path('bakg/principal.png') ?>'); color: #fff; }
      #cabecera { width: 450px; margin: 30px auto 0 auto; border-bottom: 1px dotted #fff; text-align: center; padding-bottom: 5px; }
      #cuerpo { width: 450px; margin: 15px auto 0 auto; }
      #tdh_pie_contenido { width: 450px; margin: 15px auto 0 auto; float: none; border-top: 1px dotted #fff; }
    </style>
  </head>
  <body>
    
    <div id="cabecera"><?php echo image_tag('logo_principal_beta.png', array('alt' => 'Templo de Hécate 8.0 beta')) ?></div>
    <div id="cuerpo" class="eh_auth_signin_form tdh_formulario">
      <form action="<?php echo url_for(sfConfig::get('app_eh_auth_plugin_uri_signin', '@eh_auth_signin')) ?>" method="post">
        <fieldset>
          <?php echo $form->renderGlobalErrors() ?>
          <ul>
            <?php echo $form['username']->renderRow() ?>
            <?php echo $form['password']->renderRow() ?>
            
            <li class="tdh_checkbox">
              <?php echo $form['remember'] ?> <?php echo $form['remember']->renderLabel() ?> 
            </li>
            <li class="tdh_submit">
              <input type="submit" value="Entrar" name="entrar" />
              <?php echo $form->renderHiddenFields() ?>
            </li>
          </ul>
        
        </fieldset>
      </form>
    </div>
    
    <div id="tdh_pie_contenido">
      <ul>
        <li class="tdh_menu_hecate7"><a href="http://www.templodehecate.com">Templo de Hécate 7.0</a></li>
        <li class="tdh_menu_facebook"><a href="http://www.facebook.com/templodehecate">Nuestra página en Facebook</a></li>
        <li class="tdh_menu_googleplus"><a href="https://plus.google.com/b/109403501792356941433/">Nuestra página en Google+</a></li>
        <li class="tdh_menu_twitter"><a href="http://twitter.com/templodehecate">Síguenos en Twitter</a></li>
        <li class="tdh_menu_youtube"><a href="http://www.youtube.com/user/templodehecate">Nuestro canal de YouTube</a></li>
      </ul>
    </div>
    
  </body>
</html>
