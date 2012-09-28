<?php use_stylesheet('tdh8_listados', 'last') ?>

<div id="tdh_sorteo_lista" class="tdh_contenido_lista">
  <h1><?php echo tdh_set_title('Sorteos') ?></h1>
  
  <div class="tdh_lista">
    <ul>
      <?php if($pager->getNbResults() < 1): ?>
      <li><h2>No hay ningún sorteo disponible.</h2></li>
      <?php else: ?>      
      <?php foreach($pager->getResults() as $sorteo): ?>
      <li>
        <div class="tdh_captura">
          <?php echo link_to(image_tag($sorteo->getImagePath('peq'), array('alt' => $sorteo->getNombre())), '@tdh_sorteo?slug='.$sorteo->getSlug()) ?>
        </div>
        <div class="tdh_detalles">
          <h2><?php echo link_to($sorteo->getNombre(), '@tdh_sorteo?slug='.$sorteo->getSlug()) ?></h2>
          <div class="tdh_entradilla"><?php echo $sorteo->getEntradilla() ?></div>
        </div>
        
        <div class="tdh_fix"></div>
      </li>
      <?php endforeach ?>
      <?php endif ?>
    </ul>
  </div>
  
  <div class="tdh_paginacion"><?php include_partial('seccion/paginas', array('pager' => $pager, 'uri' => '@tdh_sorteos?')) ?></div>
</div>