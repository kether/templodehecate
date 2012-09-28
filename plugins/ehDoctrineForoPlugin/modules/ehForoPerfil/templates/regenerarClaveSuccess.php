<?php use_stylesheet('/ehDoctrineForoPlugin/css/ehforo.formularios.css', 'last') ?>

<?php include_partial('ehForoTablon/sucesos') ?>

<?php $sf_context->getResponse()->setTitle('Regenerar contraseña • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array('Regenerar contraseña')
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_regenerar_clave" class="eh_foro_formulario">
  <h1>Regenerar contraseña</h1>
  
  <div class="eh_foro_descripcion">
    Escribe el e-mail que utilizaste para registrarte en la web o el nombre de usuario y se te enviará automáticamente al buzón
    una clave nueva con la que podrás identificarte en el sistema (podrás cambiarla luego por una que te guste más). 
  </div>
  
  <form action="<?php echo url_for('@eh_foro_perfil_regenerar_clave') ?>" method="post">
    <fieldset>
      <ul>
        <?php echo $form ?>
        <li class="eh_foro_submit"><input type="submit" name="enviar" value="Enviar contraseña" class="eh_foro_button_submit" /></li>
      </ul>
    </fieldset>
  </form>
  
</div>