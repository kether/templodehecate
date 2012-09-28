<?php use_helper('Date', 'Number') ?>
<?php use_stylesheet('tdh8_contenidos', 'last') ?>

<?php slot('extra') ?>
<div class="tdh_informacion">
  <ul>
    <li>creado: <?php echo format_datetime($anuncio->getUpdatedAt(), 'dd MMMM yyyy') ?></li>
    <?php if($anuncio->isPagado()): ?>
    <li>pagado: <?php echo format_datetime($anuncio->getPago()->getCreatedAt(), 'dd MMMM yyyy HH:mm') ?></li>
    <?php endif ?>
    <li>clicks: <?php echo $anuncio->getClicks() ?></li>
  </ul>
</div>
<?php end_slot() ?>

<?php slot('navegacion') ?>
<?php include_component('publicidad', 'misAnuncios') ?>
<?php end_slot() ?>

<div id="tdh_articulo" class="tdh_contenido">
  <h1><?php echo tdh_set_title('Promoción: '.$anuncio->getNombre()) ?></h1>
  
  <div class="tdh_cuerpo">
    <p>A continuación los detalles técnicos de la promoción:</p>
    <ul>
      <li><strong>Nombre:</strong> <?php echo $anuncio->getNombre() ?></li>
      <li><strong>Descripción:</strong> <?php echo $anuncio->getDescripcion() ?></li>
      <li><strong>URL:</strong> <?php echo link_to($anuncio->getUrl(), $anuncio->getUrl()) ?></li>
      <li><strong>Intervalo*:</strong> Desde <?php echo format_datetime($anuncio->getDesde(), 'd') ?> hasta <?php echo format_datetime($anuncio->getHasta(), 'd') ?></li>
      <li><strong>Tipo:</strong> <?php echo $anuncio->getTipo()->getNombre() ?></li>
      <li><strong>Tamaño (ancho X alto):</strong> <?php echo $anuncio->getTipo()->getAnchura() ?>px X <?php echo $anuncio->getTipo()->getAltura() ?>px</li>
      <?php if(!$anuncio->getEsFlash() && $anuncio->hasRecurso()): ?>
      <li><?php echo image_tag($anuncio->getRecursoPath(), array('alt' => $anuncio->getNombre())) ?></li>
      <?php endif ?>
    </ul>
    
    <p>* El intervalo compienza a las doce de media noche (00:00 am) y termina también a esa misma hora del día "hasta".</p>
  
  </div>
</div>