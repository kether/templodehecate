<?php use_stylesheet('tdh8_sorteo') ?>
<?php use_helper('Date') ?>

<div id="tdh_sorteo">
  
  <?php if($sorteo->hasImage()): ?><div class="tdh_banner_sorteo"><?php echo link_to(image_tag($sorteo->getImagePath('gra'), array('alt' => $sorteo->getNombre())), '@tdh_sorteo?slug='.$sorteo->getSlug()) ?></div><?php endif ?>
  
  <h1><?php echo tdh_set_title('Sorteo '.$sorteo->getNombre()) ?></h1>
  
  <div class="tdh_descripcion tdh_cuerpo">
    <?php echo $sorteo->getDescripcionHtml() ?>
  </div>
  
  <?php if($sorteo->periodoAbierto()): ?>
  <div class="tdh_opcion_social">
    <h2>Participa con tu red social favorita</h2>
    <h3>Desde el <?php echo format_datetime($sorteo->getDesde(), 'f') ?> hasta el <?php echo format_datetime($sorteo->getHasta(), 'f') ?></h3>
    
    <div id="tdh_opcion_facebook" class="tdh_opcion"><a href="<?php echo url_for('@tdh_sorteo_facebook?slug='.$sf_request->getParameter('slug')) ?>" title="Facebook"><span>Facebook</span></a></div>
    <div id="tdh_opcion_twitter" class="tdh_opcion"><a href="<?php echo url_for('@tdh_sorteo_twitter?slug='.$sf_request->getParameter('slug')) ?>" title="Twitter"><span>Twitter</span></a></div>
  </div>
  <?php else: ?>
  <div class="tdh_ganador">
    <?php if($sorteo->getSemilla()): ?>
    <p>Y el ganador es...</p>
    <p>¡<?php echo $sorteo->getGanador() ?>!</p>
    <p class="tdh_nota"><strong>Nota:</strong> ponte en contacto con nosotros si no recibes ningún e-mail nuestro para poder recibir tu premio.</p>
    <?php else: ?>
    ¡Próximamente se anunciará el ganador!
    <?php endif ?>
  </div>
  <?php endif ?>
</div>