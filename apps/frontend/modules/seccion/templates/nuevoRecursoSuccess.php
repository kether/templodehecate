<!-- Nueva recurso -->
<?php if($sf_user->hasFlash('exito')): ?>
<script type="text/javascript">$(document).ready(function(){ tdhIrA('<?php echo url_for('@tdh_seccion?seccion_slug='.$sf_request->getParameter('seccion_slug')) ?>'); });</script>
<div class="tdh_form_nota">La noticia se guardó, está siendo redirigido...</div>
<?php else: ?>
<form action="<?php echo url_for('@tdh_seccion_nuevo_recurso?seccion_slug='.$sf_request->getParameter('seccion_slug').'&contenido_id='.$sf_request->getParameter('contenido_id')) ?>" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend><?php echo link_to_if($sf_request->hasParameter('url_admin'), 'Recurso', $sf_request->getParameter('url_admin')) ?></legend>
    
    <div id="tdh_form_nota">
      Una vez envíes el recurso éste será revisado por los coordinadores antes de que se vea publicada en el sitio web.
      Procura escribir sin faltas de ortografía, respetando la gramática y usando párrafos cortos para la descripción.
      Puedes usar <a href="http://joedicastro.com/pages/markdown.html" target="_blank">markdown</a> para enriquecer el texto.
    </div>
    
    <div id="tdh_form_asunto" class="tdh_form">
      <?php echo $form['PrimerMensaje']['asunto']->renderLabel() ?>
      <?php echo $form['PrimerMensaje']['asunto']->render() ?>
    </div>
    
    <div id="tdh_form_entradilla" class="tdh_form">
      <?php echo $form['Recurso']['entradilla']->renderLabel() ?>
      <?php echo $form['Recurso']['entradilla']->render() ?>
    </div>
    
    <div id="tdh_form_cuerpo" class="tdh_form">
      <?php echo $form['PrimerMensaje']['cuerpo']->renderLabel() ?>
      <?php echo $form['PrimerMensaje']['cuerpo']->render() ?>
    </div>
    
    <div id="tdh_form_tipo" class="tdh_form">
      <?php echo $form['Recurso']['tipo_id']->renderLabel() ?>
      <?php echo $form['Recurso']['tipo_id']->render() ?>
    </div>
    
    <div id="tdh_form_licencia" class="tdh_form">
      <?php echo $form['Recurso']['licencia_id']->renderLabel() ?>
      <?php echo $form['Recurso']['licencia_id']->render() ?>
    </div>
    
    <div id="tdh_form_autor" class="tdh_form">
      <?php echo $form['Recurso']['autor']->renderLabel() ?>
      <?php echo $form['Recurso']['autor']->render() ?>
    </div>
    
    <div id="tdh_form_pdf" class="tdh_form">
      <?php echo $form['pdf']->renderLabel() ?>
      <?php echo $form['pdf']->render() ?>
    </div>
    
    <div id="tdh_form_image" class="tdh_form">
      <?php echo $form['image']->renderLabel() ?>
      <?php echo $form['image']->render() ?>
    </div>
    
    <?php echo $form->renderHiddenFields() ?>
    
  </fieldset>
    
  <?php if($sf_user->esColaborador($sf_request->getParameter('seccion_slug'))): ?>
  <fieldset>
    <legend>Colaborador</legend>
    
    <div id="tdh_form_estado_oculto" class="tdh_form">
      <?php echo $form['PrimerMensaje']['estado_activo']->renderLabel() ?>
      <?php echo $form['PrimerMensaje']['estado_activo']->render() ?>
    </div>
    
    <div id="tdh_form_url" class="tdh_form">
      <?php echo $form['PrimerMensaje']['visible_desde']->renderLabel() ?>
      <?php echo $form['PrimerMensaje']['visible_desde']->render() ?>
    </div>
    
  </fieldset>
  <?php endif ?>
  
  <div class="tdh_submit">
    <input type="submit" name="enviar" value="Enviar recurso" />
    <?php echo link_to('Cancelar', '@tdh_seccion?seccion_slug='.$sf_request->getParameter('seccion_slug'), array('onclick' => "$('#tdh_formulario_recurso').slideUp(); return false;")) ?>
  </div>
  
</form>
<?php endif ?>