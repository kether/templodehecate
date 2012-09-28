<?php use_stylesheet('tdh8_asociaciones', 'last') ?>

<div id="tdh_asociacion">
	<h1><?php echo tdh_set_title($asociacion->getNombre()) ?></h1>
	
	<div class="tdh_descripcion"></div>
	
	<?php echo link_to('Editar', '@tdh_asociacion_editar?id='.$asociacion->getId()) ?>
</div>