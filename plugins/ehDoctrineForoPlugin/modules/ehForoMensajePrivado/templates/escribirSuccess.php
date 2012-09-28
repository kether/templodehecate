<?php $sf_response->setTitle('Escribir mensaje privado • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array($perfil->getNickArreglado(), '@eh_foro_perfil?username='.$perfil->getUsuario(), 'Enviar mensaje a: ')
  ))); ?>
<?php end_slot() ?>

<?php include_partial('ehForoMensaje/editarMensaje', array(
        'msgForm'       => $msgForm['mimensaje'], 
        'id'            => 'eh_foro_mensaje_privado', 
        'hiddenFields'  => $msgForm->getEmbeddedMensaje()->renderHiddenFields().$msgForm->renderHiddenFields(),
        'action'        => url_for('@eh_foro_privados_escribir?username='.$sf_request->getParameter('username')),
        'cancel'        => '@eh_foro_perfil?username='.$perfil->getUsuario(),
        'legend'        => sprintf('Enviar mensaje privado a «%s»', $perfil->getNickArreglado()))) ?>