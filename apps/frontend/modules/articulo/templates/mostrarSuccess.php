<?php use_helper('Date', 'ehUtilesRutas') ?>
<?php use_stylesheet('tdh8_contenidos', 'last') ?>

<?php slot('menu_administrador', link_to_app('Editar artículo', 'backend', 'tdh_articulo_edit', array('id' => $articulo->getHilo()->getId()))) ?>

<?php slot('extra') ?>
<div class="tdh_informacion">
  <ul>
    <li>por: <?php echo link_to($articulo->getMensaje()->getNick(), '@eh_foro_perfil?username='.$articulo->getMensaje()->getUsuario()) ?></li>
    <li>creado: <?php echo format_datetime($articulo->getMensaje()->getFechaPublicacion(), 'dd MMMM yyyy') ?></li>
    <li>actualizado: <?php echo format_datetime($articulo->getMensaje()->getFechaActualizacion(), 'dd MMMM yyyy') ?></li>
  </ul>
</div>
<?php end_slot() ?>

<?php slot('navegacion') ?>
<?php end_slot() ?>

<div id="tdh_articulo" class="tdh_contenido">
  <h1><?php echo tdh_set_title($articulo->getTitular()) ?></h1>
  
  <!-- Cuerpo del contenido -->
  <div class="tdh_cuerpo"><?php echo $articulo->getMensaje()->getCuerpoHtml() ?></div>
</div>