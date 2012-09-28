<?php use_helper('Date') ?>

<?php use_javascript('tdh.comentarios.js', 'last') ?>
<?php $comentarios = $hilo->getPagerComentarios($sf_request->getParameter('pagina', 1)) ?>

<h2>Comentarios (<?php echo $comentarios->getNbResults() ?>)</h2>
<ul>
  <?php if($comentarios->getNbResults() > 0): ?>
  <?php foreach($comentarios->getResults() as $comentario): ?>
  <li class="tdh_comentario" id="<?php echo 'comentario'.$comentario->getId() ?>">
    <div class="tdh_comentario_avatar">
      <?php echo $comentario->getUsuarioId() ? link_to(image_tag($comentario->getPerfil()->getAvatarMiniPath(), array('alt' => $comentario->getNick())), '@eh_foro_perfil?username='.$comentario->getUsuario()) : image_tag(ehForoConfig::getStatic('path_avatar_default'), array('alt' => $comentario->getNick())) ?>
    </div>
    <div class="tdh_comentario_contenido">
      <div class="tdh_comentario_opciones">
        <?php if($comentario->estaUsuarioAutorizado($sf_user, ehForoMensaje::NIVEL_ACCESO_MODERADOR)): ?>
        <?php echo '<a href="" title="Eliminar comentario" onclick="tdhRemoveComentario('.$comentario->getId().', '.$comentarios->getPage().', \''.url_for('@tdh_comentarios').'\'); return false;">'.image_tag('btns/comment_remove.png', array('alt' => 'Borrar comentario')).'</a>'; ?>
        <?php endif ?>
      </div>
      <div class="tdh_comentario_autor"><?php echo $comentario->getUsuarioId() ? link_to($comentario->getNick(), '@eh_foro_perfil?username='.$comentario->getUsuario()) : $comentario->getNick() ?></div>
      <div class="tdh_comentario_fecha"><?php echo format_datetime($comentario->getCreatedAt(), 'dddd, dd MMMM yyyy HH:mm') ?></div>
      <div class="tdh_comentario_cuerpo"><?php echo $comentario->getCuerpoHtml() ?></div>
    </div>
  </li>
  <?php endforeach ?>
  <?php else: ?>
  <li class="tdh_no_comentarios">¿Quiéres ser el primero en comentar este artículo?</li>
  <?php endif ?>
</ul>

<?php if ($comentarios->haveToPaginate()): ?>
<div class="tdh_paginacion">
  <ul>
  <?php if($comentarios->getPage() > $comentarios->getPreviousPage()): ?>
    <li class="tdh_pagina_anterior"><?php echo '<a href="#" onclick="tdhLinkComentarios('.$hilo->getId().', '.$comentarios->getPreviousPage().', \''.url_for('@tdh_comentarios').'\'); return false;">Anterior</a>' ?></li>
  <?php endif ?>
  
  <?php if(($comentarios->getPage() - 5) > 0): ?>
    <li><?php echo '<a href="#" onclick="tdhLinkComentarios('.$hilo->getId().', '.$comentarios->getFirstPage().', \''.url_for('@tdh_comentarios').'\'); return false;">...</a>' ?></li>
  <?php endif ?>
    
  <?php $links = $comentarios->getLinks(5); foreach ($links as $pagina): ?>
    <li><?php echo ($pagina == $comentarios->getPage()) ? '<span class="tdh_pagina_actual">'.$pagina.'</span>' : '<a href="#" onclick="tdhLinkComentarios('.$hilo->getId().', '.$pagina.', \''.url_for('@tdh_comentarios').'\'); return false;">'.$pagina.'</a>' ?></li>   
  <?php endforeach ?>
  
  <?php if($comentarios->getLastPage() > $comentarios->getCurrentMaxLink()): ?>
    <li><?php echo '<a href="#" onclick="tdhLinkComentarios('.$hilo->getId().', '.$comentarios->getLastPage().', \''.url_for('@tdh_comentarios').'\'); return false;">...</a>' ?></li>
  <?php endif ?>
  
  <?php if($comentarios->getPage() < $comentarios->getNextPage()): ?>
    <li class="tdh_pagina_siguiente"><?php echo '<a href="#" onclick="tdhLinkComentarios('.$hilo->getId().', '.$comentarios->getNextPage().', \''.url_for('@tdh_comentarios').'\'); return false;">Siguiente</a>' ?></li>
  <?php endif ?>
  </ul>
</div>
<?php endif ?>

<?php if(ehForoConfig::canPost() && !$hilo->getEstadoCerrado()): ?>
<div id="tdh_agregar_comentario">
  <form onsubmit="tdhPostComentario(this, '<?php echo url_for('@tdh_comentarios') ?>'); return false;" action="<?php echo url_for('@tdh_comentarios') ?>" id="tdh_form_agregar_comentario" method="post">
    <fieldset>
      <?php $form = new tdhComentarioForm(null, array('user' => $sf_user, 'hilo_id' => $hilo->getId())); ?>
      <ul>  
        <?php if(isset($form['nombre_invitado'])): ?>
        <li><?php echo $form['nombre_invitado']->render() ?> <label for="eh_foro_mensaje_nombre_invitado">Nombre o seudónimo</label></li>
        <?php endif ?>
        <li><?php echo $form['cuerpo']->render() ?></li>
        <li class="tdh_submit">
          <div id="tdh_cargando_comentario"><?php echo image_tag('loader_comentarios.gif', array('alt' => 'Cargando')) ?></div>
          <?php echo $form->renderHiddenFields() ?>
          <input type="hidden" id="tdh_url_return" name="url_return" value="<?php echo $_SERVER['PHP_SELF'] ?>" />
          <input type="submit" id="tdh_enviar_comentario" value="Enviar comentario" />
        </li>
      </ul>
    </fieldset>
  </form>
</div>
<?php endif ?>