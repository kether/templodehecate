<?php use_helper('ehUtiles') ?>

<div class="tdh_title">Compra y venta en Pokipsi</div>

<ul>
  <?php foreach($feed as $i => $producto): ?>
  <li><?php echo link_to(cadena_truncada($producto->getTitle(), 30), $producto->getLink()) ?></li>
  <?php if($i >= 3) break; // Rompemos el ciclo al llegar a cuatro productos ?>
  <?php endforeach ?>
</ul>