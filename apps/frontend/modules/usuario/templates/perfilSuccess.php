<?php use_helper('Date', 'I18N') ?>
<?php use_stylesheet('tdh8_perfil', 'last') ?>
<?php use_javascript(ehForoConfig::getStatic('theme_path').'/js/jquery.ehforoplugin.js', 'last') ?>

<?php slot('extra') ?>
<div id="tdh_avatar_perfil">
  <?php echo link_to_if($sf_user->isAuthenticated() && $usuario->getId() == $sf_user->getUserId(), image_tag($perfil->getAvatarPath(), array('alt' => $perfil->getNickArreglado())), '@eh_foro_perfil_cambiar_avatar') ?>
</div>  

<div class="tdh_menu">
  <ul>
    <li class="datos"><?php echo link_to('Información y datos', '@eh_foro_perfil_datos?username='.$usuario->getUsername()) ?></li>
    <?php if($perfil->getPerfilFacebook()): ?><li class="facebook">
      <?php echo link_to('Facebook', $perfil->getPerfilFacebook()) ?>
      <a class="tdh_vincular" href="<?php echo url_for(sprintf('@tdh_vincular_servicio?servicio=%s&username=%s&estado=%s', 'facebook', $usuario->getUsername(), 0)) ?>" onclick="efpAjaxClickAndRemove('<?php echo url_for(sprintf('@tdh_vincular_servicio?servicio=%s&username=%s&estado=%s', 'facebook', $usuario->getUsername(), 0)) ?>', '.tdh_menu li.facebook'); return false;"><span>Desvincular</span></a>
    </li><?php endif ?>
    <?php if($perfil->getPerfilTwitter()): ?><li class="twitter">
      <?php echo link_to('Twitter', 'http://twitter.com/'.$perfil->getPerfilTwitter()) ?>
      <a class="tdh_vincular" href="<?php echo url_for(sprintf('@tdh_vincular_servicio?servicio=%s&username=%s&estado=%s', 'twitter', $usuario->getUsername(), 0)) ?>" onclick="efpAjaxClickAndRemove('<?php echo url_for(sprintf('@tdh_vincular_servicio?servicio=%s&username=%s&estado=%s', 'twitter', $usuario->getUsername(), 0)) ?>', '.tdh_menu li.twitter'); return false;"><span>Desvincular</span></a>
    </li><?php endif ?>
    <?php if($perfil->getPerfilGplus()): ?><li class="gplus"><?php echo link_to('Google+', $perfil->getPerfilGplus()) ?></li><?php endif ?>
    <?php if($perfil->getPerfilTuenti()): ?><li class="tuenti"><?php echo link_to('Tuenti', $perfil->getPerfilTuenti()) ?></li><?php endif ?>
    <?php if($sf_user->isAuthenticated()): ?>
      <?php if($usuario->getId() != $sf_user->getUserId()): ?><li class="mensaje_privado"><?php echo link_to('Enviar mensaje privado', '@eh_foro_privados_escribir?username='.$usuario->getUsername()) ?></li><?php endif ?>
      <?php if($usuario->getId() == $sf_user->getUserId()): ?>
      <li class="editar"><?php echo link_to('Editar perfil', '@eh_foro_perfil_editar') ?></li>
      <li class="clave"><?php echo link_to('Cambiar contraseña', '@eh_foro_perfil_cambiar_clave') ?></li>
      <li class="cambiar_avatar"><?php echo link_to('Cambiar avatar', '@eh_foro_perfil_cambiar_avatar') ?></li>
      <?php endif ?>
    <?php endif ?>
  </ul>
</div>

<?php if($amigos->count() > 0): ?>
<div class="tdh_amigos">
  <h2><?php echo link_to('Siguiendo', '@eh_foro_amigos?username='.$usuario->getUserName()) ?></h2>
  
  <ul>
    <?php foreach($amigos as $amigo): ?>
    <li>
      <div class="tdh_avatar"><?php echo link_to(image_tag($amigo->getPerfil()->getAvatarMiniPath(), array('alt' => $amigo->getPerfil()->getNickArreglado())), '@eh_foro_perfil?username='.$amigo->getUsername()) ?></div>
      <div class="tdh_nombre">
        <h3><?php echo link_to($amigo->getPerfil()->getNickArreglado(), '@eh_foro_perfil?username='.$amigo->getUsername()) ?></h3>
      </div>
    </li>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>
<?php end_slot() ?>

<?php slot('navegacion') ?>
<?php if($recursos->count() > 0): ?>
<div id="tdh_biblioteca">
  <h2><?php echo link_to('Recursos favoritos', '@tdh_recurso_lista?perfil='.$usuario->getUsername()) ?></h2>
  <ul>
    <?php foreach($recursos as $key => $recurso): ?>
    <li>
      <div class="tdh_portada"><?php echo link_to(image_tag($recurso->getImagePath('covpeq', true, false), array('alt' => $recurso->getTitular())), $recurso->getRouting()) ?></div>
      <div class="tdh_informacion">
        <h3><?php echo link_to($recurso->getTitular(), $recurso->getRouting()) ?></h3>
        <p><?php echo $recurso->getTipo() ?> <?php echo $recurso->getSeccion()->getTipo()->getEsJuego() ? 'para '.link_to($recurso->getSeccion(), '@tdh_seccion?seccion_slug='.$recurso->getSeccion()->getSlug()) : '' ?></p>
        <?php if($recurso->getAutor()): ?><p>Por <?php echo $recurso->getAutor() ?></p><?php endif ?>
      </div>
    </li>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>
<?php end_slot() ?>

<div id="tdh_muro">
  <h1><?php echo tdh_set_title($perfil->getNickArreglado()) ?></h1>

  <?php if(!is_null($amistad)): ?>
  <div id="<?php echo 'eh_foro_perfil_amigar_'.$usuario->getId() ?>" class="tdh_amigar">
    <?php include_partial('ehForoPerfil/amigar', array('usuario_id' => $usuario->getId(), 'on' => $amistad)) ?>
  </div>
  <?php endif ?>
  
  <div id="tdh_informacion">
    <span class="suscripcion">Suscrito el <?php echo format_datetime($perfil->getUsuario()->getCreatedAt(), 'D') ?></span>
    <span class="comentarios"><?php echo $perfil->getNumMensajes() ?></span>
    <span class="sexo"><?php echo $perfil->getSexo() ?></span>
    <span class="pais"><?php echo format_country($perfil->getPais()) ?></span>
    <?php echo $perfil->getWeb() ? '<a href="'.$perfil->getWeb().'" class="web">Mi web</a>' : '' ?>
  </div>
  
  <?php if($favoritos->count() > 0): ?>
  <div id="tdh_juegos_favoritos_muro">
    <script type="text/javascript">$(document).ready(function() { tdhToolTipPatrocinador('#tdh_juegos_favoritos_muro li a[title]'); });</script>
  
    <ul>
      <?php foreach($favoritos as $favorito): ?>
      <li id="<?php echo 'tdh_seccion_favorita_'.$favorito->getId() ?>"><?php echo link_to(image_tag($favorito->getImagen('icon'), array('alt' => $favorito->getNombre())), '@tdh_seccion?seccion_slug='.$favorito->getSlug(), array('title' => $favorito->getNombre())) ?></li>
      <?php endforeach ?>
    </ul>
  </div>
  <?php endif ?>
  
  <div id="tdh_actividad">
    <ul>
      <?php foreach($actividad as $key => $hilo): ?>
      <li>
        <div class="tdh_asunto">
          <?php if($hilo->isPrimeroIgualUltimo()): ?>
          Nuevo tema en <?php echo link_to($hilo->getTablon(), sprintf('@eh_foro_tablon?id=%s&pagina=%s', $hilo->getTablonId(), 1)) ?> sobre <?php echo link_to($hilo->getAsunto(), sprintf('@eh_foro_tema?id=%s&pagina=%s', $hilo->getId(), 1)) ?>
          <?php else: ?>
          Respuesta al tema <?php echo link_to($hilo->getAsunto(), sprintf('@eh_foro_tema?id=%s&pagina=%s', $hilo->getId(), 1)) ?> en <?php echo link_to($hilo->getTablon(), sprintf('@eh_foro_tablon?id=%s&pagina=%s', $hilo->getTablonId(), 1)) ?>
          <?php endif ?>
        </div>
        <div class="tdh_informacion">
          <span class="fecha">Hace <?php echo time_ago_in_words($hilo->getUltimoMensaje()->getFechaPublicacion('U')) ?></span>
          <span class="comentarios"><?php echo $hilo->getRespuestas() ?> comentarios</span>
        </div>
      </li>
      <?php endforeach ?>
    </ul>
  
  </div>
</div>
