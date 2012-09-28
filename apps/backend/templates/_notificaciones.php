<div id="tdh_notificaciones" style="<?php echo ($sf_user->hasFlash('exito') || $sf_user->hasFlash('error') || $sf_user->hasFlash('nota')) ? 'display: inherit;' : '' ?>" onclick="$('#tdh_notificaciones').fadeToggle('fast');">
<?php 
if($sf_user->hasFlash('exito')) {
  printf('<span class="%s">%s</span>', 'tdh_notificacion_exito', $sf_user->getFlash('exito'));
}elseif($sf_user->hasFlash('success')){
  printf('<span class="%s">%s</span>', 'tdh_notificacion_exito', $sf_user->getFlash('success'));
}elseif($sf_user->hasFlash('error')){
  printf('<span class="%s">%s</span>', 'tdh_notificacion_error', $sf_user->getFlash('error'));
}elseif($sf_user->hasFlash('nota')){
  printf('<span class="%s">%s</span>', 'tdh_notificacion_nota', $sf_user->getFlash('nota'));
}elseif($sf_user->hasFlash('notice')){
  printf('<span class="%s">%s</span>', 'tdh_notificacion_nota', $sf_user->getFlash('notice'));
}elseif($sf_user->hasFlash('info')){
  printf('<span class="%s">%s</span>', 'tdh_notificacion_info', $sf_user->getFlash('info'));
} ?>
</div>