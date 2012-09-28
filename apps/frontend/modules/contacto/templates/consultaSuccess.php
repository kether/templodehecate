<?php use_helper('Date') ?>
<?php use_stylesheet('tdh8_contacto.css', 'last') ?>

<div id="tdh_consulta">
  <h1><?php echo tdh_set_title('Vista de la consulta') ?></h1>
  
  <div class="tdh_descripcion">
    <h2>Consulta enviada por <?php echo $consulta->getNombre() ?></h2>
    <div class="tdh_fecha"><?php echo format_datetime($consulta->getCreatedAt(), 'F') ?></div>
    <p><?php echo nl2br($consulta->getDescripcion()) ?></p>
  </div>
  
  <div id="tdh_consulta_respuestas">
    <?php include_partial('respuestas', array('consulta' => $consulta)) ?>
  </div>
  
  <div id="tdh_consulta_respuesta">
    <?php include_partial('formularioRespuesta', array('consulta' => $consulta, 'respuestaForm' => $respuestaForm)) ?>
  </div>
</div>