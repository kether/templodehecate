<?php use_javascript(ehForoConfig::getStatic('theme_path').'/js/tagger.js') ?>

<?php $sf_response->setTitle('Editar mensaje • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => isset($tema) ? array
    (
      array($tema->getTablon()->getNombre(), '@eh_foro_tablon?pagina=1&id='.$tema->getTablon()->getId()),
      array($tema->getAsunto(), '@eh_foro_tema?pagina=1&id='.$tema->getId(), 'Tema: '),
      array($msgForm->getObject()->getAsunto(), '@eh_foro_mensaje?id='.$msgForm->getObject()->getId(), 'Mensaje: ')
    )
    :
    array
    (
      array($msgForm->getObject()->getAsunto(), '@eh_foro_mensaje?id='.$msgForm->getObject()->getId())
    )
  )); ?>
<?php end_slot() ?>

<?php $sf_response->setTitle(ehForoConfig::getStatic('nombre').' • Editar mensaje') ?>

<?php include_partial('ehForoMensaje/editarMensaje', array(
        'msgForm'       => $msgForm, 
        'id'            => isset($msgForm['asunto']) ? 'eh_foro_editar_tema' : 'eh_foro_editar_respuesta', 
        'hiddenFields'  => $msgForm->renderHiddenFields(),
        'action'        => url_for('@eh_foro_mensaje_editar?mensaje_id='.$sf_request->getParameter('mensaje_id')),
        'cancel'				=> '@eh_foro_mensaje?id='.$msgForm->getObject()->getId(),
        'legend'        => 'Editar mensaje')) ?>