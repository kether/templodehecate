<div id="tdh_banner_frame">
  <div class="tdh_wrapper">
    <div id="tdh_banner_skyscraper">
      <?php if($banner): ?>
      <?php if($banner->getEsFlash()): ?>
      <object width="<?php echo $banner->getTipo()->getAncho() ?>" height="<?php echo $banner->getTipo()->getAlto() ?>">
        <param name="movie" value="<?php echo $banner->getRecursoPath() ?>" />
        <param name="quality" value="high" />
        <embed src="<?php echo $banner->getRecursoPath() ?>" type="application/x-shockwave-flash" width="<?php echo $banner->getTipo()->getAncho() ?>" height="<?php echo $banner->getTipo()->getAlto() ?>"></embed>
      </object>
      <?php else: ?>
      <?php echo link_to(image_tag($banner->getRecursoPath(), array('alt' => $banner->getNombre())), '@tdh_publicidad_url?id='.$banner->getId(), array('title' => $banner->getNombre().($banner->getDescripcion() ? ': '.$banner->getDescripcion() : ''))) ?>
      <?php endif ?>
      <?php else: ?>
      <?php echo $bannerTipo->getCodigoAlternativo() ?>
      <?php endif ?>
    </div>
  </div>
  <div id="tdh_banner_pokipsi">
    <?php include_component('publicidad', 'pokipsi') ?>
  </div>
</div>
