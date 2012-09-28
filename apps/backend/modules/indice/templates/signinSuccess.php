<?php use_helper('Templo') ?>
<?php use_stylesheet('tdh8_formularios', 'last') ?>

<script type="text/javascript">
  $(function(){
    $(".tdh_button_submit").button();
  });
</script>

<div class="eh_auth_signin_form tdh_formulario">
  <h1><?php echo tdh_set_title('Autentificación') ?></h1>
    
  <div class="tdh_descripcion">
    Debes identificarte como un administrador del sistema para poder acceder al panel de control.
  </div>
  
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
          <input type="submit" value="Entrar" class="tdh_button_submit" />
          <?php echo $form->renderHiddenFields() ?>
        </li>
      </ul>
    
    </fieldset>
  </form>
</div>