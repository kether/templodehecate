<?php use_stylesheet('tdh8_asociaciones', 'last') ?>
<?php use_stylesheet('tdh8_formularios', 'last') ?>

<?php slot('navegacion') ?>
<h2>Opciones</h2>
<ul>
  <li><?php echo link_to('Volver a '.$form->getObject()->getNombre(), '@tdh_asociacion?slug='.$form->getObject()->getSlug()) ?></li>
</ul>
<?php end_slot() ?>

<script type="text/javascript">
  $(function(){
    $(".tdh_submit input[type=submit]").button();
  });
</script>

<div id="tdh_asociacion_editar" class="tdh_formulario">
	<h1><?php echo tdh_set_title('Editar asociación') ?></h1>

  <form action="<?php url_for('@tdh_asociacion_editar?id='.$form->getObject()->getId()) ?>" method="post" enctype="multipart/form-data">
  	<fieldset>
    <ul>
      <?php echo $form ?>
      <li class="tdh_submit"><input type="submit" name="enviar" value="Grabar" /></li>
    </ul>
    </fieldset>
  </form>

</div>