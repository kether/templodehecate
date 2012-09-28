<?php use_javascript(ehForoConfig::getStatic('theme_path').'/js/tagger.js') ?>

<?php $sf_response->setTitle('Nuevo tema en '. $tablon->getNombre().' • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array($tablon->getNombre(), '@eh_foro_tablon?pagina=1&id='.$tablon->getId())
  ))); ?>
<?php end_slot() ?>

<?php include_partial('ehForoMensaje/editarMensaje', array(
        'msgForm'       => $msgForm['mensaje'], 
        'id'            => 'eh_foro_editar_tema', 
        'hiddenFields'  => $msgForm->getEmeddedMensaje()->renderHiddenFields().$msgForm->renderHiddenFields(),
        'action'        => url_for('@eh_foro_mensaje_nuevo?tablon_id='.$sf_request->getParameter('tablon_id')),
        'cancel'				=> '@eh_foro_tablon?pagina=1&id='.$tablon->getId(),
        'legend'        => sprintf('Nuevo tema en «%s»', $tablon->getNombre()))) ?>
