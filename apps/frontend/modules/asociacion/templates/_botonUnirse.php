<span class="tdh_socios">Socios: <?php echo $asociacion->getNumSocios() ?></span>

<?php if($sf_user->isAuthenticated()): ?>
<span class="tdh_inscripcion">
  <?php if($asociacion->esUsuarioIdSocio($sf_user->getUserId())): ?>
  <?php echo link_to('Abandonar grupo', '@tdh_asociacion_solicitud?ingresar=0&id='.$asociacion->getId(), array('onclick' => "tdhIngresarGrupo('".url_for('@tdh_asociacion_solicitud?ingresar=0&id='.$asociacion->getId())."', '#tdh_inscripcion_".$asociacion->getId()."'); return false;")); ?>
  <?php elseif($asociacion->esUsuarioIdInvitado($sf_user->getUserId())): ?>
  <?php echo link_to('Eliminar invitación', '@tdh_asociacion_solicitud?ingresar=0&id='.$asociacion->getId(), array('onclick' => "tdhIngresarGrupo('".url_for('@tdh_asociacion_solicitud?ingresar=0&id='.$asociacion->getId())."', '#tdh_inscripcion_".$asociacion->getId()."'); return false;")); ?>    
  <?php elseif($asociacion->getAceptaInvitaciones() == 'no'): ?>
  <span class="tdh_inscripcion_privado">Grupo privado</span>
  <?php else: ?>
  <?php echo link_to($asociacion->getAceptaInvitaciones() == 'invitaciones' ? 'Petición de ingreso' : 'Ingresar en grupo', '@tdh_asociacion_solicitud?ingresar=1&id='.$asociacion->getId(), array('onclick' => "tdhIngresarGrupo('".url_for('@tdh_asociacion_solicitud?ingresar=1&id='.$asociacion->getId())."', '#tdh_inscripcion_".$asociacion->getId()."'); return false;")); ?>
  <?php endif ?>  
</span>
<?php endif ?>