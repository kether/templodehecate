<?php use_helper('Date', 'ehUtiles') ?>

<ul class="tdh_lista">
  <?php foreach($eventos as $evento): ?>
  <li>
    <div class="tdh_fecha">
      <div class="tdh_mes"><?php echo format_date($evento->getFechaInicio(), 'MMM') ?></div>
      <div class="tdh_dia"><?php echo format_date($evento->getFechaInicio(), 'dd') ?></div>
    </div>
    <div class="tdh_descripcion">
      <h3><?php echo link_to(cadena_truncada($evento->getTitular(), 30), $evento->getRouting()) ?></h3>
      <div class="tdh_lugar"><?php echo $evento->getDireccionCorta() ?></div>
    </div>
  </li>
  <?php endforeach ?>
</ul>

<div class="tdh_opciones_pie">
  <div class="tdh_apartado"><?php echo link_to('Calendario', '@tdh_evento_agenda_cruda') ?></div>
  <ul>
    <li class="tdh_rss"><?php echo link_to('RSS', '@tdh_feed?tipo=eventos') ?></li>
    <li class="tdh_calender"><?php echo link_to('iCal', '@tdh_evento_agenda_cruda?sf_format=vcs') ?></li>
  </ul>
</div>