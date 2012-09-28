<div class="eh_foro_botones">
  <input type="image" src="<?php echo image_path(ehForoConfig::getStatic('theme_path').'/images/btn-save.png') ?>" name="save" value="Grabar" />  
  <?php echo link_to(image_tag(ehForoConfig::getStatic('theme_path').'/images/btn-cancel.png', array('alt' => 'Cancelar')), $cancel ? $cancel : '@eh_foro', array('onclick' => 'efpCancelarRespuesta(); return false;')) ?>
  <!-- <input type="image" src="<?php echo image_path(ehForoConfig::getStatic('theme_path').'/images/btn-preview.png') ?>" name="preview" value="Vista previa" /> -->
</div>