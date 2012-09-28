<?php use_helper('Date', 'I18N') ?>

<?php $sf_response->setTitle('Perfil de '.$perfil->getNickArreglado().' • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array($sf_user->getUserId() == $perfil->getUsuarioId() ? 'Mi perfil' : 'Perfil de '.$perfil->getNickArreglado())
  ))); ?>
<?php end_slot() ?>

<?php include_partial('ehForoTablon/sucesos') ?>

<div id="eh_foro_perfil">
  <div class="eh_foro_columna_1 eh_foro_columna">
    <?php echo image_tag($perfil->getAvatarPath(), array('alt' => $perfil->getNickArreglado())) ?>
  </div>
  
  <div class="eh_foro_columna_2 eh_foro_columna">
    <h1>Perfil de «<?php echo $perfil->getNickArreglado() ?>»</h1>
    
    
    <div class="eh_foro_opciones_perfil">
      <ul>
        <?php if($perfil->getUsuarioId() != $sf_user->getUserId()): ?>
        <li><?php echo link_to_if($sf_user->isAuthenticated(), 'Enviar mensaje privado', '@eh_foro_privados_escribir?username='.$perfil->getUsuario()) ?></li>
        <?php else: ?>
        <li><?php echo link_to('Editar perfil', '@eh_foro_perfil_editar') ?></li>
        <li><?php echo link_to('Cambiar contraseña', '@eh_foro_perfil_cambiar_clave') ?></li>
        <li><?php echo link_to('Modificar avatar', '@eh_foro_perfil_cambiar_avatar') ?></li>
        <?php endif ?>
      </ul>
    </div>
    
  
    <ul class="eh_foro_detalles">
		  <li><span class="eh_foro_label">Nombre de usuario</span><span class="eh_foro_field"><?php echo $perfil->getUsuario()->getUsername() ?></span></li>
		  <li><span class="eh_foro_label">Seudónimo</span><span class="eh_foro_field"><?php echo $perfil->getNick() ? $perfil->getNick() : 'No definido' ?></span></li>
		  <li><span class="eh_foro_label">Registrado desde</span><span class="eh_foro_field"><?php echo format_datetime($perfil->getUsuario()->getCreatedAt(), 'D') ?></span></li>
      <li><span class="eh_foro_label">Sitio web/blog</span><span class="eh_foro_field"><?php echo $perfil->getWeb() ? '<a href="'.$perfil->getWeb().'">'.$perfil->getWeb().'</a>' : 'No definido' ?></span></li>
      <li><span class="eh_foro_label">Mensajes enviados</span><span class="eh_foro_field"><?php echo $perfil->getNumMensajes() ?> mensajes</span></li>
      <li><span class="eh_foro_label">Sexo</span><span class="eh_foro_field"><?php echo $perfil->getSexo() ?></span></li>
      <li><span class="eh_foro_label">Idioma</span><span class="eh_foro_field"><?php echo format_language($perfil->getIdioma()) ?></span></li>
      <?php if(($perfil->getUsuarioId() == $sf_user->getUserId()) || $sf_user->isAdministrador()): ?>
      <!-- Detalles privados -->
      <li><span class="eh_foro_label">Correo electrónico*</span><span class="eh_foro_field"><?php echo mail_to($perfil->getEmail()) ?></span></li>
      <li><span class="eh_foro_label">Fecha de nacimiento*</span><span class="eh_foro_field"><?php echo format_datetime($perfil->getFechaNacimiento(), 'D') ?></span></li>
      <li><span class="eh_foro_label">Residencia*</span><span class="eh_foro_field"><?php echo $perfil->getResidencia() ? $perfil->getResidencia() : 'Mundo' ?></span></li>
      <li><span class="eh_foro_label">País*</span><span class="eh_foro_field"><?php echo format_country($perfil->getPais()) ?></span></li>
      <li><span class="eh_foro_label">Zona horaria*</span><span class="eh_foro_field"><?php echo $perfil->getZonaHoraria() ?></span></li>
      <?php endif ?>
      <li>
        <span class="eh_foro_label">Conexión</span>
        <?php if($perfil->comprobarEstadoUsuarioActivo()):  ?>
        <span class="eh_foro_field eh_foro_online">Conectado</span>
		    <?php else: ?>
		    <span class="eh_foro_field eh_foro_offline">Desconectado</span>
		    <?php endif ?>
      </li>
    </ul>
	  <div class="eh_foro_nota">
      *Los datos privados sólo pueden verlos el propietario y los administradores.
    </div>
    
    
    <?php if($perfil->getFirma()): ?>
    <div class="eh_foro_firma_perfil">
      <h3>Firma</h3>
      <?php echo $perfil->getFirma() ?>
    </div>
    <?php endif ?>
    
	  
  </div>
  
  <div class="eh_foro_clearfix"></div>
</div>