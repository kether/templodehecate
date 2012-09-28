<?php use_helper('Date', 'ehUtilesRutas') ?>

<?php use_stylesheet('tdh8_contenidos', 'last') ?>

<?php $sf_response->setTitle($noticia->getTitular().' • '.sfConfig::get('app_nombre')) ?>
<?php slot('menu_administrador', link_to_app('Editar noticia', 'backend', 'tdh_noticia_edit', array('id' => $noticia->getHilo()->getId()))) ?>

<?php if($sf_request->hasParameter('seccion_slug')): ?>
<?php slot('submenu_pre', '<li>'.link_to('Noticias de '.$noticia->getSeccion()->getNombre(), '@tdh_seccion_noticia_lista?pagina=1&seccion_slug='.$noticia->getSeccion()->getSlug()).'</li>') ?>
<?php include_partial('seccion/decorador', array('seccion' => $noticia->getSeccion())) ?>
<?php endif ?>

<?php slot('extra') ?>
<?php if($noticia->getEntradilla()):?>
<div class="tdh_entradilla">
  <?php echo $noticia->getEntradilla() ?>
</div>
<?php slot('meta_description', $noticia->getEntradilla()) ?>
<?php endif ?>

<div class="tdh_informacion">
  <ul>
    <li>por: <?php echo link_to($noticia->getMensaje()->getNick(), '@eh_foro_perfil?username='.$noticia->getMensaje()->getUsuario()) ?></li>
    <?php if($noticia->getNombreFuente()): ?>
    <li>fuente: <?php try { echo $noticia->getUrlFuente() ? link_to($noticia->getNombreFuente(), $noticia->getUrlFuente()) : $noticia->getNombreFuente(); } catch(sfException $e) { echo $noticia->getNombreFuente(); } ?></li>
    <?php endif ?>
    <li><?php echo format_datetime($noticia->getMensaje()->getFechaPublicacion(), 'dddd, dd MMMM yyyy HH:mm') ?></li>
  </ul>
</div>
<?php end_slot() ?>

<?php slot('navegacion') ?>
<?php if($otros): ?>
<div class="tdh_otros_contenidos">
  <h2>Noticias relacionadas</h2>
  <ul>
    <?php foreach($otros as $otro): ?>
    <li>
      <h3><?php echo link_to($otro->getTitular(), '@tdh_noticia?id='.$otro->getId().'&slug='.$otro->getMensaje()->getSlug()) ?></h3>
      <div class="tdh_fecha"><?php echo format_datetime($otro->getMensaje()->getFechaPublicacion(), 'F') ?></div>
    </li>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>
<?php end_slot() ?>

<div id="tdh_noticia" class="tdh_contenido">
  <h1><?php echo $noticia->getTitular() ?></h1>
  <div class="tdh_seccion"><?php echo link_to_if($noticia->getSeccion()->getTipo()->getEsJuego(), $noticia->getSeccion()->getNombre(), '@tdh_seccion?seccion_slug='.$noticia->getSeccion()->getSlug()) ?></div>
  
  <?php if($noticia->hasImage('med')): ?>
  <!-- Imagen de cabecera destacada -->
  <div class="tdh_imagen_cabecera">
    <?php echo image_tag($noticia->getImagePath('med'), array('alt' => $noticia->getTitular())) ?>
  </div>
  <?php endif ?>
  
  <!-- Cuerpo del contenido -->
  <div class="tdh_cuerpo"><?php echo $noticia->getMensaje()->getCuerpoHtml() ?></div>
  
  <?php include_partial('seccion/compartir', array('url' => url_for('@tdh_noticia?id='.$noticia->getId().'&slug='.$noticia->getMensaje()->getSlug(), true))) ?>  
</div>

<div id="tdh_comentarios">
  <?php include_partial('seccion/comentarios', array('hilo' => $noticia->getHilo())) ?>
</div>