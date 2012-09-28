<div id="tdh_menu_principal">
  <?php try { ?>
  <ul>
  <?php foreach($menuPrincipal as $key => $menu): ?>  
    <li class="tdh_opcion_<?php echo $key; echo $menu['foco'] ? ' tdh_foco' : ($menu['especial'] ? ' tdh_especial' : ''); ?>">
      <?php echo link_to($menu['nombre'], $menu['uri']) ?>
    </li>
  <?php endforeach ?>
  </ul>
  <?php } catch(Exception $e) { use_helper('Debug'); log_message('El URI de alguna opción del menú principal no es válido.', 'err'); } ?>
</div>

<div id="tdh_submenu_principal">
  <?php try { ?>
  <?php if($submenuPrincipal): ?>
  <ul>
    <?php foreach($submenuPrincipal as $menu): ?>
    <li><?php echo link_to($menu['nombre'], $menu['uri']) ?></li>
    <?php endforeach ?>
  </ul>
  <?php endif ?>
  <?php } catch(Exception $e) { use_helper('Debug'); log_message('El URI de alguna opción del submenú principal no es válido.', 'err'); } ?>
</div>