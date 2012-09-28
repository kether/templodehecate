<div id="tdh_pie">
  <div class="tdh_wrapper">
    <div id="tdh_pie_logo">
      <?php echo link_to(image_tag('/images/logo_principal_mini.png', array('alt' => sfConfig::get('app_nombre'))), '@homepage', array('title' => sfConfig::get('app_nombre'))) ?>
    </div>
  </div>
  
  <?php $menu = sfConfig::get('app_menu_pie', array()) ?>
  
  <div id="tdh_pie_contenido">
    <ul>
      <?php if($sf_user->esColaborador()): ?>
      <!-- Opciones de administrador -->
      <li class="tdh_menu_admin">
        <?php include_slot('menu_administrador', link_to_app('Ir al panel del administrador', 'backend', 'homepage')) ?>
      </li>
      <?php endif ?>
      <?php foreach($menu as $key => $opcion): ?>
      <li class="<?php echo 'tdh_menu_'.$key ?>"><?php echo link_to($opcion['title'], $opcion['route']) ?></li>
      <?php endforeach ?>
    </ul>
  </div>
  
  <div id="tdh_pie_copyright">
    1998, <?php echo date('Y', time()) ?> &copy; <?php echo link_to('Estudio Hécate, SL', 'http://www.estudiohecate.com') ?>. <?php echo sfConfig::get('app_lema') ?>
  </div>
  <div class="tdh_fix"></div>
</div>