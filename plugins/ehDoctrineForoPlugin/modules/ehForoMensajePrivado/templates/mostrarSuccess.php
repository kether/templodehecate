<?php use_helper('Date', 'ehForo') ?>

<?php $sf_response->setTitle(($mensaje->getAsunto() ? $mensaje->getAsunto() : '(Sin asunto)').' • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    $mensaje->getUsuarioId() == $sf_user->getUserId() ?
      array('Mensajes enviados', '@eh_foro_privados_enviados?pagina=1') :
      array('Mensajes recibidos', '@eh_foro_privados_recibidos?pagina=1'),
    array($mensaje->getAsunto())
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_encabezado">
  <h1><?php echo $mensaje->getAsunto() ? $mensaje->getAsunto() : '(Sin asunto)' ?></h1>
</div>

<div class="eh_foro_botones">
  <?php echo link_to(image_tag('/ehDoctrineForoPlugin/images/btn-sended.png', array('Mensajes enviados')), '@eh_foro_privados_enviados?pagina=1') ?>
  <?php echo link_to(image_tag('/ehDoctrineForoPlugin/images/btn-received.png', array('Mensajes recibidos')), '@eh_foro_privados_recibidos?pagina=1') ?>
</div>

<?php include_partial('ehForoMensaje/mensaje', array('mensaje' => $mensaje, 'ver_mensaje' => false, 'privado_id' => $privado->getId())) ?>

<?php if($mensaje->getUsuario() != $sf_user->getUserName()): ?>
<div class="eh_foro_botones">
  <?php echo link_to(image_tag('/ehDoctrineForoPlugin/images/btn-reply.png', array('Responder')), '@eh_foro_privados_escribir?username='.$mensaje->getUsuario().'&asunto='.$mensaje->getAsunto()) ?>
</div>
<?php endif ?>