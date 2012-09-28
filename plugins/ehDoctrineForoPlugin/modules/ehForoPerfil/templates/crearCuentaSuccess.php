<?php use_stylesheet('/ehDoctrineForoPlugin/css/ehforo.formularios.css', 'last') ?>

<?php $sf_response->setTitle('Crear nueva cuenta • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array('Crear nueva cuenta')
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_perfil_crear" class="eh_foro_formulario">
  
  <h1>Crear nueva cuenta de usuario</h1>
  
  <div class="eh_foro_descripcion">El proceso inscripción es fácil y gratuito, sólo es necesario rellenar los campos que aparecen a continuación.</div>
  
  <form action="<?php echo url_for('@eh_foro_perfil_crear') ?>" method="post">
    <fieldset>
      <?php echo $form->renderGlobalErrors() ?>
      <ul>
        <?php echo $form['username']->renderRow() ?>
        <?php echo $form['password']->renderRow() ?>
        <?php echo $form['password_again']->renderRow() ?>
        <?php echo $form['Perfil'] ?>
        <?php if(isset($form['recaptcha'])): ?>
        <li class="eh_foro_recaptcha">
          <div class="eh_foro_label">
            <?php echo $form['recaptcha']->renderLabel() ?>
            <?php echo $form['recaptcha']->renderHelp() ?>
          </div>
          <?php echo $form['recaptcha'] ?>
          <?php echo $form['recaptcha']->renderError() ?>
        </li>
        <?php endif ?>
        <li class="eh_foro_submit"><input type="submit" value="Crear cuenta" class="eh_foro_button_submit" /></li>
      </ul>
    </fieldset>
  </form>
  
  <div class="eh_foro_alternativas">
    <ul>
      <li>Si te registraste previamente <?php echo link_to('autentificate', '@eh_auth_signin') ?> aquí.</li>
    </ul>
  </div>
  
</div>