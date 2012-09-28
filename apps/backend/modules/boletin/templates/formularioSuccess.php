<?php use_helper('Templo') ?>
<?php use_stylesheet('tdh8_formularios', 'last') ?>

<script type="text/javascript">
  $(function(){
    $("input[type=submit]").button();
    $(".boton").button();
  });
</script>

<div class="tdh_boletin_form tdh_formulario">
  
  <h1><?php echo tdh_set_title('Boletín para correo electrónico') ?></h1>
  
  <form method="post" action="<?php echo url_for('@tdh_boletin') ?>">
    <fieldset>
      <ul>
        <?php echo $formulario ?>
        <li class="tdh_submit">
          <input type="submit" name="encolar" value="Poner en cola" />
          <?php if($spool > 0): ?>
            <?php echo link_to('Lanzar eMails encolados ('.$spool.')', '@tdh_boletin_enviar', array('class' => 'boton')) ?>
            <?php echo link_to('Vacíar cola', '@tdh_boletin_vaciar', array('class' => 'boton')) ?>
            
          <?php endif ?>
        </li>
      </ul>
    </fieldset>
  </form>
  
</div>