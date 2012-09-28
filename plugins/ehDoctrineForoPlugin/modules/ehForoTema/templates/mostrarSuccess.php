<?php use_helper('Date', 'ehForo') ?>

<?php use_javascript(ehForoConfig::getStatic('theme_path').'/js/tagger.js') ?>
<?php use_javascript(ehForoConfig::getStatic('theme_path').'/js/jquery.ehforoplugin.js') ?>

<?php $sf_response->setTitle($tema->getTablon()->getNombre().': '. $tema->getAsunto().' • '.ehForoConfig::getStatic('nombre')) ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array($tema->getTablon()->getNombre(), '@eh_foro_tablon?pagina=1&id='.$tema->getTablon()->getId()),
    array($tema->getAsunto())
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_encabezado">
  <!-- [EHF-THREAD-PRESUBJECT] -->
  <h1><?php echo $tema->getAsunto() ?></h1>
  <!-- [EHF-THREAD-POSTSUBJECT] -->
</div>

<div id="eh_foro_hilo_mensajes">
  
  <div class="eh_foro_opciones">
    <div class="eh_foro_paginas"><?php echo $mensajes->getNbResults() ?> mensajes <?php if($mensajes->haveToPaginate()): ?>• <?php include_partial('ehForoTema/paginas', array('pager' => $mensajes, 'uri' => '@eh_foro_tema?id='.$tema->getId())) ?><?php endif ?></div>
  </div>
  
  <?php foreach($mensajes->getResults() as $key => $mensaje): ?>
  <?php include_partial('ehForoMensaje/mensaje', array('mensaje' => $mensaje, 'esPrimerMensaje' => $mensaje->getId() == $tema->getPrimerMensajeId(), 'esPar' => $key % 2 == 0)) ?>
  <?php endforeach ?>
  
  <div class="eh_foro_opciones">
    <div class="eh_foro_paginas"><?php echo $mensajes->getNbResults() ?> mensajes <?php if($mensajes->haveToPaginate()): ?>• <?php include_partial('ehForoTema/paginas', array('pager' => $mensajes, 'uri' => '@eh_foro_tema?id='.$tema->getId())) ?><?php endif ?></div>
  </div>
  
  <div id="eh_foro_form_responder"></div>
</div>

<?php if($sf_user->isAuthenticated() || ehForoConfig::getStatic('permiso_post_invitados')): ?>
<div class="eh_foro_botones">
  <?php echo link_to(image_tag(ehForoConfig::getStatic('theme_path').'/images/btn-reply.png', array('alt' => 'Responder')), '@eh_foro_mensaje_responder?hilo_id='.$tema->getId(), array('onclick' => 'efpResponder(\''.url_for('@eh_foro_mensaje_responder?hilo_id='.$tema->getId()).'\'); return false;')) ?>
</div>
<?php endif ?>