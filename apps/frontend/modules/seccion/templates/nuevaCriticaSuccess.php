<!-- Nueva recurso -->
<?php if($sf_user->hasFlash('exito')): ?>
<script type="text/javascript">$(document).ready(function(){ tdhIrA('<?php echo url_for('@tdh_seccion?seccion_slug='.$sf_request->getParameter('seccion_slug')) ?>'); });</script>
<div class="tdh_form_nota">La noticia se guardó, está siendo redirigido...</div>
<?php else: ?>
<form action="<?php echo url_for('@tdh_seccion_nueva_critica?seccion_slug='.$sf_request->getParameter('seccion_slug').'&contenido_id='.$sf_request->getParameter('contenido_id')) ?>" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend><?php echo link_to_if($sf_request->hasParameter('url_admin'), 'Reseña', $sf_request->getParameter('url_admin')) ?></legend>
    
    <div id="tdh_form_nota">
      Una vez envíes la reseña ésta será revisada por los coordinadores antes de que se vea publicada en el sitio web.
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
    
    <div id="tdh_form_estado_basico" class="tdh_form">
      <?php echo $form['Critica']['estado_basico']->renderLabel() ?>
      <?php echo $form['Critica']['estado_basico']->render() ?>
    </div>
    
    <div id="tdh_form_fecha_publicacion" class="tdh_form">
      <?php echo $form['Critica']['fecha_publicacion']->renderLabel() ?>
      <?php echo $form['Critica']['fecha_publicacion']->render() ?>
    </div>
    
    <div id="tdh_form_editor" class="tdh_form">
      <?php echo $form['Critica']['editor_id']->renderLabel() ?>
      <?php echo $form['Critica']['editor_id']->render() ?>
    </div>
    
    <div id="tdh_form_autor" class="tdh_form">
      <?php echo $form['Critica']['autor']->renderLabel() ?>
      <?php echo $form['Critica']['autor']->render() ?>
    </div>
    
    <div id="tdh_form_idioma" class="tdh_form">
      <?php echo $form['Critica']['idioma']->renderLabel() ?>
      <?php echo $form['Critica']['idioma']->render() ?>
    </div>
    
    <div id="tdh_form_paginas" class="tdh_form">
      <?php echo $form['Critica']['paginas']->renderLabel() ?>
      <?php echo $form['Critica']['paginas']->render() ?>
    </div>
    
    <div id="tdh_form_precio" class="tdh_form">
      <?php echo $form['Critica']['precio']->renderLabel() ?>
      <?php echo $form['Critica']['precio']->render() ?>
    </div>
    
    <div id="tdh_form_moneda" class="tdh_form">
      <?php echo $form['Critica']['moneda']->renderLabel() ?>
      <?php echo $form['Critica']['moneda']->render() ?>
    </div>
    
    <div id="tdh_form_nota" class="tdh_form">
      <?php echo $form['Critica']['nota']->renderLabel() ?>
      <?php echo $form['Critica']['nota']->render() ?>
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
    <input type="submit" name="enviar" value="Enviar crítica" />
    <?php echo link_to('Cancelar', '@tdh_seccion?seccion_slug='.$sf_request->getParameter('seccion_slug'), array('onclick' => "$('#tdh_formulario_recurso').slideUp(); return false;")) ?>
  </div>
  
</form>
<?php endif ?>