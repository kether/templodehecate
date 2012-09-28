<?php use_stylesheet(ehForoConfig::getStatic('theme_path').'/css/ehforo.formularios.css', 'last') ?>
<?php $sf_response->setTitle('Cargar fichero '.($mensaje->getAsunto() ? 'en '.$mensaje->getAsunto() : '').' • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array($mensaje->getAsunto(), '@eh_foro_mensaje?id='.$mensaje->getId(), 'Mensaje: ')
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_cargar_ficheros" class="eh_foro_formulario">
	<h1>Cargar ficheros para el mensaje</h1>
  
  <div class="eh_foro_descripcion">Puedes adjuntar ficheros a éste mensaje mediante el formulario de carga de archivos.</div>
  
  <form action="<?php echo url_for('@eh_foro_cargar_ficheros?mensaje_id='.$mensaje->getId()) ?>" method="post" enctype="multipart/form-data">
	  <fieldset>
	    <ul>
	      <?php echo $msgForm ?>
	      <li class="eh_foro_submit"><input type="submit" value="Cargar fichero" /></li>
	    </ul>
	  </fieldset>
	</form>
</div>