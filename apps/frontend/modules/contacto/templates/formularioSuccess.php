<?php use_stylesheet('tdh8_contacto.css', 'last') ?>

<script type="text/javascript">
  $(function(){
    $(".tdh_submit input[type=submit]").button();
  });
</script>

<div id="tdh_consulta">
  <h1><?php echo tdh_set_title('Formulario de contacto') ?></h1>
  
  <form action="<?php echo url_for('@tdh_contacto') ?>" method="post" class="tdh_formulario">
    <fieldset>
    <ul>  
      <?php echo $form ?>
      <li class="tdh_submit"><input type="submit" value="Enviar" name="enviar" /></li>
    </ul>
    </fieldset>
  </form>
  
</div>