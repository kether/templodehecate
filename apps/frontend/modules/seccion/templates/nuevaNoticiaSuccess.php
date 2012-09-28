<!-- Nueva noticia -->
<?php if($sf_user->hasFlash('exito')): ?>
<script type="text/javascript">$(document).ready(function(){ tdhIrA('<?php echo url_for('@tdh_seccion?seccion_slug='.$sf_request->getParameter('seccion_slug')) ?>'); });</script>
<div class="tdh_form_nota">La noticia se guardó, está siendo redirigido...</div>
<?php else: ?>
<form action="<?php echo url_for('@tdh_seccion_nueva_noticia?seccion_slug='.$sf_request->getParameter('seccion_slug').'&contenido_id='.$sf_request->getParameter('contenido_id')) ?>" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend><?php echo link_to_if($sf_request->hasParameter('url_admin'), 'Noticia', $sf_request->getParameter('url_admin')) ?></legend>
    
    <div id="tdh_form_nota">
      Una vez envíes la noticia ésta será revisada por los coordinadores antes de que se vea publicada en el sitio web.
      Procura escribir sin faltas de ortografía, respetando la gramática y usando párrafos cortos para la descripción.
      Puedes usar <a href="http://joedicastro.com/pages/markdown.html" target="_blank">markdown</a> para enriquecer el texto.
    </div>
    
    <div id="tdh_form_asunto" class="tdh_form">
      <?php echo $form['PrimerMensaje']['asunto']->renderLabel() ?>
      <?php echo $form['PrimerMensaje']['asunto']->render() ?>
    </div>
    
    <div id="tdh_form_entradilla" class="tdh_form">
      <?php echo $form['Noticia']['entradilla']->renderLabel() ?>
      <?php echo $form['Noticia']['entradilla']->render() ?>
    </div>
    
    <div id="tdh_form_cuerpo" class="tdh_form">
      <?php echo $form['PrimerMensaje']['cuerpo']->renderLabel() ?>
      <?php echo $form['PrimerMensaje']['cuerpo']->render() ?>
    </div>
    
    <div id="tdh_form_fuente" class="tdh_form">
      <?php echo $form['Noticia']['nombre_fuente']->renderLabel() ?>
      <?php echo $form['Noticia']['nombre_fuente']->render() ?>
    </div>
    
    <div id="tdh_form_url" class="tdh_form">
      <?php echo $form['Noticia']['url_fuente']->renderLabel() ?>
      <?php echo $form['Noticia']['url_fuente']->render() ?>
    </div>
    
    <div id="tdh_form_imagen" class="tdh_form">
      <?php echo $form['imagen']->renderLabel() ?>
      <?php echo $form['imagen']->render() ?>
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
    <input type="submit" name="enviar" value="Enviar noticia" />
    <?php echo link_to('Cancelar', '@tdh_seccion?seccion_slug='.$sf_request->getParameter('seccion_slug'), array('onclick' => "$('#tdh_formulario_recurso').slideUp(); return false;")) ?>
  </div>
  
</form>
<?php endif ?>