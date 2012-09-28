<?php use_helper('Date', 'Number') ?>
<?php use_stylesheet('tdh8_contenidos', 'last') ?>
<?php use_stylesheet('tdh8_publicidad', 'last') ?>

<?php slot('extra') ?>
<div class="tdh_informacion">
  <ul>
    <li><?php echo link_to('Haz una consulta', '@tdh_contacto') ?></li>
    <li>Estadísticas de <?php echo tdhConfig::get('nombre') ?></li>
    <?php if($articulo): ?>
    <li>actualizado: <?php echo format_datetime($articulo->getMensaje()->getFechaActualizacion(), 'dd MMMM yyyy') ?></li>
    <?php endif ?>
  </ul>
</div>
<?php end_slot() ?>

<?php slot('navegacion') ?>
<?php include_component('publicidad', 'misAnuncios') ?>
<?php end_slot() ?>

<div id="tdh_articulo" class="tdh_contenido">
  <h1><?php echo tdh_set_title('Promocionate') ?></h1>
  
  <!-- Cuerpo del contenido -->
  <div class="tdh_cuerpo">
    <?php if($articulo): ?>
    <?php echo $articulo->getMensaje()->getCuerpoHtml() ?>
    <?php else: ?>
    <p>
      Puedes promocionarte en <strong><?php echo tdhConfig::get('nombre') ?></strong> en las ubicaciones habilitadas para ello; dependiendo
      del tipo de anuncio elegido y la duración podrás realizar el pago y empezar a ver la promoción de tu negocio automáticamente.
    </p>
    <?php endif ?>
    
    <p>
      Si necesitas consultar los precios u otros asuntos sobre promociones puedes ponerte en
      <?php echo link_to('contacto', '@tdh_contacto') ?> con nosotros.
    </p>
  </div>
  
  <div id="tdh_precios">
    <ul>
      <?php foreach($anuncios as $key => $anuncio): ?>
      <li>
        <h2><?php echo $anuncio['nombre'] ?></h2>
        <div class="tdh_dimensiones"><?php echo $anuncio['dim']['x'] ?>px de ancho y <?php echo $anuncio['dim']['y'] ?>px de alto</div>
        <div class="tdh_duracion"><?php echo $anuncio['duracion'] ?> días</div>
        <div class="tdh_precio"><?php echo format_currency($anuncio['precio'], isset($anuncio['moneda'])? $anuncio['moneda'] : 'EUR') ?></div>
        <div class="tdh_contratar"><?php echo link_to('Contratar', '@tdh_publicidad_contratar?tipo='.$key) ?></div>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>