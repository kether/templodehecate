<?php use_helper('Number') ?>

<script>
$(document).ready(function() { 
  $('#tdh_tu_valoracion form').stars({
    inputType: 'select',
    split: 2,
    oneVoteOnly: true,
    callback: function(ui, type, value)
    {
      jQuery.ajax({
        type:'POST',
        dataType:'html',
        data:jQuery('#tdh_tu_valoracion form').serialize(),
        success:function(data, textStatus){
          $('#tdh_calificacion').html(data);
        },
        url: '<?php echo url_for('@tdh_critica_votar?id='.$critica->getId()); ?>'
      });
    }
  });
});
</script>

<!-- Nuestra valoración -->
<div id="tdh_nuestra_valoracion">
  <div class="tdh_apunte">Nuestra valoración</div>
  <div class="tdh_valoracion"><?php echo $critica->getEstadoSinNota() ? 'ND' : format_number(number_format($critica->getNota(), 1)) ?></div>
</div>

<!-- Vuestra valoración -->
<div id="tdh_vuestra_valoracion">
  
  <div id="tdh_usuarios_valoracion" class="tdh_cuadros_valoracion">
    <div class="tdh_informacion_valoracion">
      <h3>Nota usuarios</h3>
      <div class="tdh_apunte"><?php echo $critica->getVotos() ?> voto(s)</div>
    </div>
    <div class="tdh_valoracion"><?php echo format_number(number_format($critica->getNotaMedia(), 1)) ?></div>
  </div>
  
  <div id="tdh_tu_valoracion" class="tdh_cuadros_valoracion">
    <div class="tdh_informacion_valoracion">
      <h3>Mi nota</h3>
      <div class="tdh_apunte">
        <?php if(!is_null($nota)): ?>
        <form method="post" action="<?php echo url_for('@tdh_critica_votar?id='.$critica->getId()) ?>">
          <fieldset>
          <?php echo $nota['nota']->render() ?>
          <?php echo $nota->renderHiddenFields() ?>
          </fieldset>
        </form>
        <?php else: ?>
        <?php echo link_to('Regístrate', '@eh_auth_signin') ?> para votar
        <?php endif ?>
      </div>
    </div>
    <div class="tdh_valoracion"><?php echo (is_null($nota) || $nota->getObject()->getNota() == 0) ? 'ND' : format_number(number_format($nota->getObject()->getNota(), 1)) ?></div>
  </div>
  
</div>