<div id="tdh_pie">
  <div class="tdh_wrapper">
	  <div id="tdh_pie_copyright">
	    1998, <?php echo date('Y', time()) ?> &copy; <?php echo link_to('Estudio Hécate, SL', 'http://www.estudiohecate.com') ?>. <?php echo sfConfig::get('app_lema') ?>
	  </div>
  </div>
  
  <?php $menu = sfConfig::get('app_menu_pie_admin', array()) ?>
  
  <div id="tdh_pie_contenido">
    <h2>Herramientas</h2>
    <ul>
      <?php if($sf_user->isAuthenticated()): ?>
      <li class="tdh_conectado"><?php echo $sf_user->getUserName() ?> (<?php echo link_to('desconectar', '@eh_auth_signout') ?>)</li>
      <?php else: ?>
      <li class="tdh_desconectado"><?php echo link_to('No conectado', '@eh_auth_signin') ?></li>
      <?php endif ?>
      
      <li class="tdh_menu_interfaz_cliente"><?php echo link_to_app('Ir al interfaz del cliente', 'frontend', 'homepage') ?></li>
      
      <?php if($sf_user->isAdministrador()): ?>
      <?php foreach($menu as $key => $opcion): ?>
      <li class="<?php echo 'tdh_menu_'.$key ?>"><?php echo link_to($opcion['title'], $opcion['route']) ?></li>
      <?php endforeach ?>
      <li><?php echo sfProjectConfiguration::getActive()->isLockApp('frontend') ? link_to('Habilitar interfaz de cliente', '@app_cambiar_estado?app=frontend').' ('.link_to('Habilitar y limpiar la caché', '@app_cambiar_estado?clean=1&app=frontend').')' : link_to('Deshabilitar la interfaz de cliente', '@app_cambiar_estado?app=frontend') ?></li>
      <?php endif ?>
    </ul>
  </div>
  
  <div id="tdh_pie_logo">
    <?php echo link_to(image_tag('/images/logo_principal_mini.png', array('alt' => sfConfig::get('app_nombre'))), '@homepage', array('title' => sfConfig::get('app_nombre'))) ?>
  </div>
  
  <div class="tdh_fix"></div>
</div>