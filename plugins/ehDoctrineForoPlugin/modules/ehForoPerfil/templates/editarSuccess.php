<?php use_stylesheet('/ehDoctrineForoPlugin/css/ehforo.formularios.css', 'last') ?>

<?php $sf_response->setTitle('Editar perfil • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array('Mi perfil', '@eh_foro_perfil?username='.$sf_user->getUserName()),
    array('Editar')
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_perfil_editar" class="eh_foro_formulario">
  
  <h1>Editar mi perfil</h1>
  
  <div class="eh_foro_descripcion">
    Modifica los datos personale del perfil.
  </div>
  
  <form action="<?php echo url_for('@eh_foro_perfil_editar') ?>" method="post">
    <fieldset>
      <ul>
        <?php echo $form ?>
        <li class="eh_foro_submit"><input type="submit" value="Grabar" /></li>
      </ul>
    </fieldset>
  </form>
  
</div>