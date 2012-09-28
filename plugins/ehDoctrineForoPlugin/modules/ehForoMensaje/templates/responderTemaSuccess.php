<?php use_javascript(ehForoConfig::getStatic('theme_path').'/js/tagger.js') ?>

<?php $sf_response->setTitle('Responder en '.$tema->getAsunto().' • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array($tema->getTablon()->getNombre(), '@eh_foro_tablon?pagina=1&id='.$tema->getTablon()->getId()),
    array($tema->getAsunto(), '@eh_foro_tema?pagina=1&id='.$tema->getId())
  ))); ?>
<?php end_slot() ?>

<?php include_partial('ehForoMensaje/editarMensaje', array(
        'msgForm'       => $msgForm, 
        'id'            => 'eh_foro_editar_respuesta', 
        'hiddenFields'  => $msgForm->renderHiddenFields(),
        'action'        => url_for('@eh_foro_mensaje_responder?hilo_id='.$sf_request->getParameter('hilo_id')),
        'cancel'				=> '@eh_foro_tema?pagina=1&id='.$tema->getId(),
        'legend'        => sprintf('Responder en «%s»', $tema->getAsunto()))) ?>