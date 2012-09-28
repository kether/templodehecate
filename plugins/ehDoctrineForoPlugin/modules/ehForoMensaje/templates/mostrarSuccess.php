<?php use_helper('Date', 'ehForo') ?>

<?php $sf_response->setTitle('Mensaje en '.$tema->getAsunto().' • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array($tema->getTablon()->getNombre(), '@eh_foro_tablon?pagina=1&id='.$tema->getTablon()->getId()),
    array($tema->getAsunto(), '@eh_foro_tema?pagina=1&id='.$tema->getId()),
    array($mensaje->getAsunto())
  ))); ?>
<?php end_slot() ?>

<?php include_partial('ehForoMensaje/mensaje', array('mensaje' => $mensaje, 'ver_mensaje' => false)) ?>

<?php if($mensaje->estaUsuarioAutorizado($sf_user, ehForoMensaje::NIVEL_ACCESO_PROPIETARIO)): ?>
<?php echo link_to_foro_editar_mensaje(image_tag(ehForoConfig::getStatic('theme_path').'/images/btn-edit.png', array('alt' => 'Editar mensaje')), $mensaje->getId()) ?>
<?php endif ?>