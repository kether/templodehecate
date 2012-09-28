<?php if($eh_foro_hilo->getCritica()->getCapturas()->count() > 0): ?>
<ul class="tdh_capturas">
  <?php foreach($eh_foro_hilo->getCritica()->getCapturas() as $captura): ?>
  <li><?php echo link_to($captura->getFichero(), '@tdh_critica_captura_edit?id='.$captura->getId(), array('title' => $captura->getComentario())) ?></li>
  <?php endforeach ?>
</ul>
<?php endif ?>