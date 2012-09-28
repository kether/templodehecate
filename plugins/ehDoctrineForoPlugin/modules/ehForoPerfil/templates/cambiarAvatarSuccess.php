<?php use_stylesheet('/ehDoctrineForoPlugin/css/ehforo.formularios.css', 'last') ?>
<?php $sf_response->setTitle('Modificar avatar • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array('Mi perfil', '@eh_foro_perfil?username='.$sf_user->getUserName()),
    array('Modificar avatar avatar')
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_cambiar_avatar" class="eh_foro_formulario">

  <h1>Modificar avatar</h1>
  
  <div class="eh_foro_descripcion">
    Carga un avatar personalizado para el perfil.
  </div>
  
  <div class="eh_foro_avatar_actual">
    <?php echo image_tag($sf_user->getAvatar(), array('alt' => 'Avatar de '.$sf_user->getNickName())) ?>
    <?php echo image_tag($sf_user->getAvatarMini(), array('alt' => 'Avatar de '.$sf_user->getNickName())) ?>
  </div>
  
  <form action="<?php echo url_for('@eh_foro_perfil_cambiar_avatar') ?>" method="post" enctype="multipart/form-data">
    <fieldset>
      <ul>
        <?php echo $form ?>
        <li class="eh_foro_submit"><input type="submit" value="Cargar avatar" /></li>
      </ul>
    </fieldset>
  </form>
  
</div>