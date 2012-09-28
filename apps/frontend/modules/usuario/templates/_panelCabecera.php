<?php if($sf_user->isAuthenticated()): ?>

<div id="tdh_avatar"><?php echo link_to(image_tag($sf_user->getAvatarMini(), array('alt' => $sf_user->getNickname())), '@eh_foro_perfil?username='.$sf_user->getUsername()) ?></div>
<div id="tdh_usuario_autorizado">
  <h2><?php echo link_to($sf_user->getNickname(), '@eh_foro_perfil?username='.$sf_user->getUsername()) ?></h2>
  <span class="tdh_panel_usuario_otros"><?php echo link_to($sf_user->getNumMensajesPrivadosNuevos().' mensajes nuevos', '@eh_foro_privados_recibidos') ?></span><br />
  <span class="tdh_panel_usuario_otros"><?php echo link_to('Salir', '@eh_auth_signout', array('class' => 'enlace_destacado')) ?> | <?php echo link_to('Ayuda', sprintf('@tdh_articulo?slug=%s', 'ayuda')) ?> | <?php echo link_to('Opciones', '@eh_foro_perfil_editar') ?></span><br />
</div>

<?php else: ?>

<?php echo link_to('Identificarse', '@eh_auth_signin') ?><br />
<span class="tdh_panel_usuario_otros"><?php echo link_to('Olvidé la contraseña', '@eh_foro_perfil_regenerar_clave') ?> | <?php echo link_to('Ayuda', sprintf('@tdh_articulo?slug=%s', 'ayuda')) ?></span><br />
<span class="tdh_panel_usuario_otros"><?php echo link_to('Crear nueva cuenta', '@eh_foro_perfil_crear', array('class' => 'enlace_destacado')) ?></span>
<?php endif ?>