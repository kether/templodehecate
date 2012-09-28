<h3>Apuntados</h3>
<?php if($evento->getPagerApuntados()->getNbResults() > 0): ?>
<ul>
<?php foreach($evento->getPagerApuntados()->getResults() as $apuntado): ?>
  <li><?php echo link_to(image_tag($apuntado->getPerfil()->getAvatarMiniPath(), array('alt' => $apuntado->getNick())), '@eh_foro_perfil?username='.$apuntado->getUsername(), array('title' => $apuntado->getNick())) ?></li> 
<?php endforeach ?>
</ul>
<?php if($evento->getPagerApuntados()->getNbResults() > 3): ?>Y <?php echo $evento->getPagerApuntados()->getNbResults() - 3 ?> personas más apuntadas<br /><?php endif ?>
<?php else: ?>
No hay apuntados.<br />
<?php endif ?>

<?php if($sf_user->isAuthenticated()): ?>
<?php if($evento->estaApuntadoUsuarioId($sf_user->getUserId())): ?>
<a href="#" onclick="jQuery.ajax({type:'GET', dataType:'html', success:function(data, textStatus){ jQuery('#tdh_apuntados').html(data);}, beforeSend:function(XMLHttpRequest){$('.tdh_cargando_apuntado').show()},url:'<?php echo url_for('@tdh_evento_apuntados?evento_id='.$evento->getId().'&apuntarme=0') ?>'}); return false;">Quitarme de este evento</a>
<?php else: ?>
<a href="#" onclick="jQuery.ajax({type:'GET', dataType:'html', success:function(data, textStatus){ jQuery('#tdh_apuntados').html(data);}, beforeSend:function(XMLHttpRequest){$('.tdh_cargando_apuntado').show()},url:'<?php echo url_for('@tdh_evento_apuntados?evento_id='.$evento->getId().'&apuntarme=1') ?>'}); return false;">Apuntarme a este evento</a>
<?php endif ?>

<div class="tdh_cargando_apuntado"><?php echo image_tag('loader_comentarios.gif', array('alt' => 'Cargando')) ?></div>
<?php endif ?>