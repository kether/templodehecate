<div class="eh_foro_botones">
  <?php echo link_to(image_tag(ehForoConfig::getStatic('theme_path').'/images/btn-reply.png', array('alt' => 'Responder')), '@eh_foro_mensaje_responder?hilo_id='.$tema_id, array('onclick' => 'efpResponder(\''.url_for('@eh_foro_mensaje_responder?hilo_id='.$tema_id).'\'); return false;')) ?>
</div>