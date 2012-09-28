<script type="text/javascript">
  $(function(){
    $(".tdh_submit input[type=submit]").button();
  });
</script>
<form action="<?php echo url_for('@tdh_contacto_guardar_respuesta?codigo='.$consulta->getCodigo()) ?>" method="post" class="tdh_formulario">
  <fieldset>
    <ul>
      <?php echo $respuestaForm ?>
      <li class="tdh_submit"><input type="submit" value="Responder" name="responder" /></li>
    </ul>
  </fieldset>
</form>