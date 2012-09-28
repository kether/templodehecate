<?php if($paginador->hayQuePaginar()): ?>
<div class="tdh_paginar_contenido">

  <ul>
    <?php if($paginador->getPagina() > 1): ?><li><?php echo link_to('Anterior', ($paginador->getPagina()-1) == 1 ? str_replace('&pag=', '', $ruta) : $ruta.($paginador->getPagina()-1)) ?></li><?php endif ?>
    <?php for($i = 1; $i <= $paginador->getPaginas(); $i++): ?>
    <?php if($i != $paginador->getPagina()): ?>
      <li><?php echo link_to($i, $i == 1 ? str_replace('&pag=', '', $ruta) : $ruta.$i) ?></li>
    <?php else: ?>
      <li class="tdh_pagina_actual"><?php echo $i ?></li>
    <?php endif ?>
    <?php endfor ?>
    <?php if($paginador->getPagina() < $paginador->getPaginas()): ?><li><?php echo link_to('Siguiente', $ruta.($paginador->getPagina()+1)) ?></li><?php endif ?>
  </ul>
  
</div>
<?php endif ?>