<?php use_stylesheet('tdh8_layout_b', 'last') ?>
<?php use_stylesheet('tdh8_formularios', 'last') ?>

<script type="text/javascript">
  $(function(){ $(".tdh_submit input[type=submit]").button(); });
</script>

<?php slot('navegacion') ?>
<div class="tdh_otras_opciones">
  <ul>
    <li class="tdh_enrutar"><?php echo link_to('¿No tienes aún una cuenta? Entonces regístrate aquí gratuitamente.', '@eh_foro_perfil_crear') ?></li>
    <li class="tdh_enrutar"><?php echo link_to('Si olvidaste tu contraseña podemos enviarte una nueva.', '@eh_foro_perfil_regenerar_clave') ?></li>
  </ul>
</div>
<?php end_slot() ?>

<div class="eh_auth_signin_form tdh_formulario">
  <h1><?php echo tdh_set_title('Autentificación') ?></h1>
    
  <div class="tdh_descripcion">
    <?php if(!$sf_request->hasParameter('auth')): ?>
    <p>Identificate en nuestro sistema para acceder a todos los servicios privados de la web si ya estás registrado.
    Si no lo estás, puedes hacerlo <?php echo link_to('aquí', '@eh_foro_perfil_crear') ?> gratuitamente.</p>
    <?php else: ?>
    <p>El <strong>servicio externo</strong> ha validado tu petición. Ahora debes introducir tu <strong>nombre de usuario</strong> y <strong>contraseña</strong> una sóla vez
    para vincular tu cuenta de <strong><?php echo tdhConfig::get('nombre') ?></strong> con la del servicio. En las sucesivas autentificaciones mediante este <strong>servicio</strong> sólo tendrás que hacer click en el botón.</p>
    <?php endif ?>
  </div>
  
  <form action="<?php echo url_for(sfConfig::get('app_eh_auth_plugin_uri_signin', '@eh_auth_signin')) ?>" method="post">
    <fieldset>
      <?php echo $form->renderGlobalErrors() ?>
      <ul>
        <?php if(!$sf_request->hasParameter('auth')): ?>
        <li class="tdh_campo">
          <div class="tdh_label">
            <label>Autenticar con</label>
            <div class="tdh_help">Usa un servicio externo</div> 
          </div>
          <?php echo link_to(image_tag('btns/signin_twitter.png', array('alt' => 'Autenticar con Twitter')), '@tdh_auth_twitter', array('title' => 'Autenticar con Twitter')) ?>
          <?php echo link_to(image_tag('btns/signin_facebook.png', array('alt' => 'Autenticar con Facebook')), '@tdh_auth_facebook', array('title' => 'Autenticar con Facebook')) ?>
        </li>
        <?php endif ?>
        
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