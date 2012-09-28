<a 
  href="<?php echo url_for('@eh_foro_perfil_amigar?usuario_id='.$usuario_id) ?>" 
  title="<?php echo $on ? 'Dejar de seguir' : 'Seguir' ?>"
  class="<?php echo $on ? 'seguir_on' : 'seguir_off'?>"
  onclick="efpAmigar('<?php echo url_for('@eh_foro_perfil_amigar?usuario_id='.$usuario_id) ?>', '<?php echo '#eh_foro_perfil_amigar_'.$usuario_id ?>'); return false;">
  <span>Seguir</span>
</a>