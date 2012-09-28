  <ul>
    <?php foreach($menu['submenus'] as $key => $opcion): ?>
    <li class="tdh_menu_gestion_<?php echo $key ?>">
      <h2><?php echo link_to($opcion['nombre'], $opcion['uri']) ?></h2>
      <div class="tdh_descripcion"><?php echo isset($opcion['descripcion']) ? $opcion['descripcion'] : 'Más información de ésta opción en el vínculo.' ?></div>
    </li>
    <?php endforeach ?>
  </ul>