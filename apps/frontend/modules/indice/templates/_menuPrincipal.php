<div id="tdh_menu_principal">
  <?php try { ?>
  <ul>
  <?php foreach($menuPrincipal as $key => $menu): ?>  
    <li class="tdh_opcion_<?php echo $key; echo $menu['foco'] ? ' tdh_foco' : ($menu['especial'] ? ' tdh_especial' : ''); ?>">
      <?php if($menu['uri'] == '@homepage' && has_slot('homepage')): ?>
        <?php include_slot('homepage') ?>
      <?php else: ?>
        <?php echo link_to($menu['nombre'], $menu['uri']) ?>
      <?php endif ?>
    </li>
  <?php endforeach ?>
  </ul>
  <?php } catch(Exception $e) { use_helper('Debug'); log_message('El URI de alguna opción del menú principal no es válido.', 'err'); } ?>
  
  <?php include_slot('socialplus') ?>
</div>

<div id="tdh_submenu_principal">
  <?php try { ?>
  <ul>
    <?php include_slot('submenu_pre') ?>
    <?php if(!include_slot('submenu') && $submenuPrincipal): ?>
    <?php foreach($submenuPrincipal as $menu): ?>
    <li><?php echo link_to($menu['nombre'], $menu['uri']) ?></li>
    <?php endforeach ?>
    <?php else: ?>
    <li></li>
    <?php endif ?>
  </ul>  
  <?php } catch(Exception $e) { use_helper('Debug'); log_message('El URI de alguna opción del submenú principal no es válido.', 'err'); } ?>
</div>