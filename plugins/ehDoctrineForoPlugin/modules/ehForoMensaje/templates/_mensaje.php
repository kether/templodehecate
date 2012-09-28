<?php use_helper('ehForo', 'Date') ?>

<div id="<?php echo 'msg'.$mensaje->getId() ?>" class="eh_foro_mensaje eh_foro_round <?php echo isset($esPrimerMensaje) ? 'eh_foro_mensaje_primero' : '' ?> <?php echo isset($esPar) ? ($esPar ? 'eh_foro_mensaje_par' : 'eh_foro_mensaje_impar') : '' ?>">
  <span class="eh_foro_top"><span></span></span>
  
  <div class="eh_foro_mensaje_contenedor" onmouseover="javascript:$('<?php echo '#msg'.$mensaje->getId() ?> .eh_foro_botonera').show()" onmouseout="javascript:$('<?php echo '#msg'.$mensaje->getId() ?> .eh_foro_botonera').hide()">
    
    <div class="eh_foro_usuario <?php echo $mensaje->estaUsuarioConectado() ? 'eh_foro_conexion_si' : 'eh_foro_conexion_no' ?>">
      <?php if(!$mensaje->isByInvitado()): ?>
      
      <div class="eh_foro_avatar">
        <?php echo link_to(image_tag((isset($esPrimerMensaje) && $esPrimerMensaje == true ? $mensaje->getPerfil()->getAvatarPath() : $mensaje->getPerfil()->getAvatarMiniPath()), array('alt' => $mensaje->getNick())), '@eh_foro_perfil?username='.$mensaje->getUsuario()) ?>
      </div>
      <div class="eh_foro_conexion"></div>
      <h2><?php echo $mensaje->getNick() ?></h2>
      <ul class="eh_foro_informacion">
        <li><?php echo $mensaje->getPerfil()->getNumMensajes() ?> mensajes</li>
      </ul>
      
      <?php else: ?>
      <h2><?php echo $mensaje->getNick() ?></h2>
      <ul class="eh_foro_informacion">
        <li>No registrado</li>
      </ul>
      <?php endif ?>
    </div>
    
    <div class="eh_foro_cabecera">
      <div class="eh_foro_botonera" style="display: none;">
	      <?php if($mensaje->estaUsuarioAutorizado($sf_user, ehForoMensaje::NIVEL_ACCESO_ADMINISTRADOR)): ?>
        <!-- Nivel de administrador -->
	      <?php echo link_to(image_tag(ehForoConfig::getStatic('theme_path').'/images/btn-remove-message.png', array('alt' => 'Eliminar mensaje')), !isset($privado_id) ? '@eh_foro_mensaje_eliminar?pagina='.$sf_request->getParameter('pagina', 1).'&mensaje_id='.$mensaje->getId() : '@eh_foro_privados_borrar?privado_id='.$privado_id, array('title' => 'Eliminar este mensaje')) ?>

	      <?php if(!isset($privado_id)): ?><?php echo link_to(image_tag(ehForoConfig::getStatic('theme_path').'/images/btn-edit-message.png', array('alt' => 'Editar mensaje')), '@eh_foro_mensaje_editar?pagina='.$sf_request->getParameter('pagina', 1).'&mensaje_id='.$mensaje->getId(), array('title' => 'Editar este mensaje')) ?><?php endif ?>
	      <?php endif ?>
	      
        <?php echo (!isset($ver_mensaje) || $ver_mensaje != false) ? link_to(image_tag(ehForoConfig::getStatic('theme_path').'/images/btn-view-message.png', array('alt' => 'Ver mensaje')), '@eh_foro_mensaje?id='.$mensaje->getId(), array('title' => 'Ver sólo este mensaje')) : '' ?>
      </div>
      <?php if($mensaje->getAsunto()): ?><h2><?php echo link_to($mensaje->getAsunto(), '@eh_foro_mensaje?id='.$mensaje->getId()) ?></h2><?php endif ?>
      <div class="eh_foro_fecha"><?php echo format_datetime($mensaje->getFechaPublicacion('U'), 'F') ?></div>
    </div>
    
    <div class="eh_foro_cuerpo">
      <?php echo $mensaje->getCuerpoHtml() ?>
    </div>
    
    <?php if($mensaje->getTieneAdjuntos()): ?>
    <div class="eh_foro_adjuntos"> 
    <?php echo foro_lista_adjuntos($mensaje->getAdjuntos()) ?>
    </div>
    <?php endif ?>
    
    <?php if($mensaje->hasFirma()): ?>
    <div class="eh_foro_firma">
    <?php echo $mensaje->getPerfil()->getFirma() ?>
    </div>
    <?php endif ?>
        
    <div class="eh_foro_pie"></div>
    
  </div>
  
  <span class="eh_foro_bottom"><span></span></span>
</div>