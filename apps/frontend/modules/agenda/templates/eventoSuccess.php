<?php use_helper('Date', 'ehUtiles') ?>

<?php use_stylesheet('tdh8_contenidos', 'last') ?>
<?php use_javascript('http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAr9FZWoXlk6kLcylw3rEdHxQsAqKpUpOJCEuKQBwWTXw6pKAZNRR9zNyJ9e84wBtAtfQLQCmUBIyepA'); ?>
<?php use_javascript('tdh.gmap.js', 'last') ?>

<?php slot('menu_administrador', link_to_app('Editar evento', 'backend', 'tdh_evento_edit', array('id' => $evento->getHiloId()))) ?>

<?php slot('extra') ?>
<?php if($evento->hasImage('med')): ?><div id="tdh_poster"><?php echo image_tag($evento->getImagePath('med')) ?></div><?php endif ?>

<div class="tdh_tiempo_evento">
  <?php if($evento->getFechaInicioDT('U') > time()): ?>
  Falta(n) <?php echo distance_of_time_in_words($evento->getFechaInicioDT('U'), time(), false) ?>
  <?php elseif($evento->getFechaFinDT('U') > time()): ?>
  ¡Celebrándose ahora!
  <?php else: ?>
  Este evento terminó
  <?php endif ?>
</div>

<?php if($noticia->getEntradilla()):?>
<div class="tdh_entradilla">
  <?php echo $noticia->getEntradilla() ?>
</div>
<?php endif ?>

<div class="tdh_informacion">
  <ul>
    <li>enviado por: <?php echo link_to($evento->getMensaje()->getNick(), '@eh_foro_perfil?username='.$evento->getMensaje()->getUsuario()) ?></li>
    <?php if($noticia->getNombreFuente()): ?>
    <li>fuente: <?php try { echo $noticia->getUrlFuente() ? link_to($noticia->getNombreFuente(), $noticia->getUrlFuente()) : $noticia->getNombreFuente(); } catch(sfException $e) { echo $noticia->getNombreFuente(); } ?></li>
    <?php endif ?>
    <li><?php echo format_datetime($evento->getMensaje()->getFechaPublicacion(), 'dddd, dd MMMM yyyy HH:mm') ?></li>
  </ul>
</div>

<div id="tdh_apuntados">
  <?php include_partial('agenda/apuntados', array('evento' => $evento)) ?>
</div>
<?php end_slot() ?>

<?php slot('navegacion') ?>
<script type="text/javascript">
  //<![CDATA[
  $(document).ready(function() {
    <?php echo $evento->getLongitud() != 0 || $evento->getLatitud() != 0 ? "tdhmap_load('".$evento->getLatitud()."', '".$evento->getLongitud()."')" : "tdhaddress_load('".$evento->getDireccionCompleta()."')" ?>
  });
  //]]>
</script>

<!-- Detalles del evento y mapa -->
<div class="tdh_evento_detalles">
  <div id="tdh_gmap"></div>
  <div class="tdh_informacion">
    <ul>
      <li class="tdh_evento_desde"><span class="tdh_tipo">Desde:</span> <?php echo format_datetime($evento->getFechaInicio(), 'dddd, dd MMMM yyyy') ?></li>
      <li class="tdh_evento_hasta"><span class="tdh_tipo">Hasta:</span> <?php echo format_datetime($evento->getFechaFin(), 'dddd, dd MMMM yyyy') ?></li>
      <?php if($evento->getDireccion()): ?><li class="tdh_evento_direccion"><span class="tdh_tipo">Dirección:</span> <?php echo $evento->getDireccion() ?></li><?php endif ?>
      <?php if($evento->getLocalidad()): ?><li class="tdh_evento_localidad"><span class="tdh_tipo">Localidad:</span> <?php echo $evento->getLocalidad() ?></li><?php endif ?>
      <?php if($evento->getRegion()): ?><li class="tdh_evento_region"><span class="tdh_tipo">Región:</span> <?php echo $evento->getRegion() ?></li><?php endif ?>
      <?php if($evento->getPais()): ?><li class="tdh_evento_pais"><span class="tdh_tipo">País:</span> <?php echo $evento->getPaisLargo() ?></li><?php endif ?>
    </ul>
  </div>
</div>

<?php if($otros->count() > 0): ?>
<!-- Otros eventos -->
<div class="tdh_otros_contenidos">
  <h2>Otros eventos</h2>
  <ul>
    <?php foreach($otros as $otro): ?>
    <li>
      <h3><?php echo link_to($otro->getTitular(), $otro->getRouting()) ?></h3>
      <div class="tdh_fecha"><?php echo format_datetime($otro->getMensaje()->getFechaPublicacion(), 'F') ?></div>
    </li>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>
<?php end_slot() ?>

<div id="tdh_evento" class="tdh_contenido">
  <h1><?php echo tdh_set_title($evento->getTitular()) ?></h1>
  <div class="tdh_lugar">Evento de <?php echo $evento->getDuracionEvento('d')+1 ?> días <?php if($evento->getLocalidad()): ?> en <?php echo $evento->getLocalidad() ?><?php endif ?></div>
  
  <!-- Cuerpo del contenido -->
  <div class="tdh_cuerpo"><?php echo $evento->getMensaje()->getCuerpoHtml() ?></div>
  
  <?php include_partial('seccion/compartir', array('url' => url_for($evento->getRouting(), true))) ?>
</div>

<div id="tdh_comentarios">
  <?php include_partial('seccion/comentarios', array('hilo' => $evento->getHilo())) ?>
</div>