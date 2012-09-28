<!-- Nuevo evento -->
<?php if($sf_user->hasFlash('exito')): ?>
<script type="text/javascript">$(document).ready(function(){ tdhIrA('<?php echo url_for('@tdh_evento_lista') ?>'); });</script>
<div class="tdh_form_nota">El evento se guardó, está siendo redirigido...</div>
<?php else: ?>
<!-- onsubmit="tdhPostRecursoSeccion(this, '#tdh_formulario_recurso', '.tdh_add_loader', '<?php echo url_for('@tdh_evento_nuevo') ?>'); return false;"  -->

<form action="<?php echo url_for('@tdh_evento_nuevo') ?>" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend>Evento</legend>
    
    <div class="tdh_form_nota">
      Una vez envíes el evento/jornada será revisada por los administradores antes de que se vea publicado en el sitio web.
      Procura escribir sin faltas de ortografía, respetando la gramática y usando párrafos cortos para la descripción.
      Puedes usar <a href="http://joedicastro.com/pages/markdown.html" target="_blank">markdown</a> para enriquecer el texto.
    </div>
    
    <div id="tdh_form_asunto" class="tdh_form">
      <?php echo $form['PrimerMensaje']['asunto']->renderLabel() ?>
      <?php echo $form['PrimerMensaje']['asunto']->render() ?>
    </div>
    
    <div id="tdh_form_cuerpo" class="tdh_form">
      <?php echo $form['PrimerMensaje']['cuerpo']->renderLabel() ?>
      <?php echo $form['PrimerMensaje']['cuerpo']->render() ?>
    </div>
    
    <div id="tdh_form_fechas" class="tdh_form">
      Desde <?php echo $form['Evento']['fecha_inicio']->render() ?> hasta <?php echo $form['Evento']['fecha_fin']->render() ?>
    </div>
    
    <div id="tdh_form_direccion" class="tdh_form">
      <?php echo $form['Evento']['direccion']->renderLabel() ?>
      <?php echo $form['Evento']['direccion']->render() ?>
    </div>
    <div id="tdh_form_localidad" class="tdh_form">
      <?php echo $form['Evento']['localidad']->renderLabel() ?>
      <?php echo $form['Evento']['localidad']->render() ?>
    </div>
    <div id="tdh_form_region" class="tdh_form">
      <?php echo $form['Evento']['region']->renderLabel() ?>
      <?php echo $form['Evento']['region']->render() ?>
    </div>
    <div id="tdh_form_pais" class="tdh_form">
      <?php echo $form['Evento']['pais']->renderLabel() ?>
      <?php echo $form['Evento']['pais']->render() ?>
    </div>
    <div id="tdh_form_portada" class="tdh_form">
      <?php echo $form['imagen']->renderLabel() ?>
      <?php echo $form['imagen']->render() ?>
    </div>
    
    <?php echo $form->renderHiddenFields() ?>
  </fieldset>
  
  <?php if($sf_user->esColaborador()): ?>
  <fieldset>
    <legend>Colaborador</legend>
    
    <div id="tdh_form_estado_oculto" class="tdh_form">
      <?php echo $form['estado_oculto']->renderLabel() ?>
      <?php echo $form['estado_oculto']->render() ?>
    </div>
    
    <div id="tdh_form_visible_desde" class="tdh_form">
      <?php echo $form['PrimerMensaje']['visible_desde']->renderLabel() ?>
      <?php echo $form['PrimerMensaje']['visible_desde']->render() ?>
    </div>
    
  </fieldset>
  <?php endif ?>
  
  <div class="tdh_submit">
    <input type="submit" name="enviar" value="Enviar evento" />
    <?php echo link_to('Cancelar', '@tdh_evento_lista', array('onclick' => "$('#tdh_formulario_recurso').slideUp(); return false;")) ?>
  </div>
</form>
<?php endif ?>