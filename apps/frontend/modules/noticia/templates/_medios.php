<?php if($novedades): ?>
<script type="text/javascript">
$(function(){
  $('#tdh_medios li').qtip({
    style: { classes: 'ui-tooltip-dark ui-tooltip-dark', width: '300px' },
    position: { my: 'right top', at: 'left top', viewport: $(window), adjust: { method: 'flip shift' } },
    content: { 
      text: function(api) { return $(this).children('.tdh_descripcion').text(); },
      title: { text: function(api) { return $(this).children('h3').text(); } } 
    }
  });
});
</script>

<div id="tdh_medios" class="tdh_otros_contenidos">
  <h2>Medios</h2>
  <ul>
    <?php $i = 0 ?>
    <?php foreach($novedades as $otro): ?>
    <li>
      <h3><?php echo link_to($otro['title'], $otro['link']) ?></h3>
      <div class="tdh_fecha"><?php echo format_datetime($otro['lastUpdate'], 'F') ?></div>
      <div class="tdh_autor"><?php echo $otro['author'] ?></div>
      <div class="tdh_descripcion"><?php echo $otro['description'] ?></div>
    </li>
    <?php $i++; if($i > tdhConfig::get('contenidos_por_pagina', 20)) break; ?>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>