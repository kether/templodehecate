<?php use_stylesheet('/ehDoctrineForoPlugin/css/ehforo.formularios.css', 'last') ?>

<?php $sf_response->setTitle('Cambiar contraseña • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array('Mi perfil', '@eh_foro_perfil?username='.$sf_user->getUserName()),
    array('Cambiar contraseña')
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_cambiar_clave" class="eh_foro_formulario">

  <h1>Modificar contraseña</h1>
  
  <div class="eh_foro_descripcion">
    Para modificar la contraseña de acceso actual escribe la nueva en los siguientes campos.
  </div>
  
  <form action="<?php echo url_for('@eh_foro_perfil_cambiar_clave') ?>" method="post">
    <fieldset>
      <ul>
        <?php echo $form ?>
        <li class="eh_foro_submit"><input type="submit" value="Aceptar contraseña" /></li>
      </ul>
    </fieldset>
  </form>
  
</div>