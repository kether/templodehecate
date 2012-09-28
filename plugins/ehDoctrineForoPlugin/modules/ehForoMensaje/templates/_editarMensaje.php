<form action="<?php echo $action ?>" method="post" id="<?php echo $id ?>" class="eh_foro_formulario">
  <fieldset>
    <legend><?php echo $legend ?></legend>
    
    <div class="eh_foro_editar_opciones eh_foro_round">
      <span class="eh_foro_top"><span></span></span>
      <ul>
        <?php if(isset($msgForm['nombre_invitado'])): ?>
        <li>
          <?php echo $msgForm['nombre_invitado']->renderLabel() ?><br />
          <?php echo $msgForm['nombre_invitado'] ?>
        </li>
        <?php endif ?>
        <?php if(isset($msgForm['html'])): ?><li><?php echo $msgForm['html'] ?> <?php echo $msgForm['html']->renderLabel() ?></li><?php endif ?>
        <li><?php echo $msgForm['bbcode'] ?> <?php echo $msgForm['bbcode']->renderLabel() ?></li>
        <?php if(isset($msgForm['markdown'])): ?><li><?php echo $msgForm['markdown'] ?> <?php echo $msgForm['markdown']->renderLabel() ?></li><?php endif ?>
        <li><?php echo $msgForm['nl2br'] ?> <?php echo $msgForm['nl2br']->renderLabel() ?></li>
        <li><?php echo $msgForm['emoticonos'] ?> <?php echo $msgForm['emoticonos']->renderLabel() ?></li>
        <?php if(isset($msgForm['firma'])): ?><li><?php echo $msgForm['firma'] ?> <?php echo $msgForm['firma']->renderLabel() ?></li><?php endif ?>
        <?php if(isset($msgForm['cargar_ficheros'])): ?><li><?php echo $msgForm['cargar_ficheros'] ?> <?php echo $msgForm['cargar_ficheros']->renderLabel() ?></li><?php endif ?>
      </ul>
      <span class="eh_foro_bottom"><span></span></span>
    </div>

    <?php if(isset($msgForm['asunto'])): ?>
    <div class="eh_foro_editar_asunto eh_foro_round">
      <span class="eh_foro_top"><span></span></span>
      <?php echo $msgForm['asunto']->render(array('tabindex' => '1')) ?>
      <span class="eh_foro_bottom"><span></span></span>
    </div>
    <?php endif ?>
    
    <div class="eh_foro_editar_cuerpo eh_foro_round">
      <span class="eh_foro_top"><span></span></span>
      
      <?php include_partial('ehForoMensaje/botonesBBCode', array('theme_dir' => ehForoConfig::getStatic('theme_path'), 'cuerpo_id' => $msgForm['cuerpo']->renderId())) ?>
      
      <?php echo $msgForm['cuerpo']->render(array('tabindex' => '2')) ?>
      <span class="eh_foro_bottom"><span></span></span>
    </div>
    
    <?php echo isset($hiddenFields) ? $hiddenFields : ''?>
    
    <?php include_partial('ehForoMensaje/botonesFormulario', array('cancel' => isset($cancel) ? $cancel : null)) ?>
  </fieldset>
</form>