<?php use_stylesheet('tdh8_favoritos', 'last') ?>

<div id="tdh_juegos_favoritos">
  <script type="text/javascript">
  $(document).ready(function() { 
    $("#tdh_juegos_favoritos ul").carouFredSel({
      auto        : { play: true, pauseDuration: 5000 },
      items       : { visible: 5 },
      scroll      : { pauseOnHover: true },
    })
    .delegate('#tdh_juegos_favoritos li a', 'mouseenter', function() { tdhToolTipPatrocinador(this); });
  });
  </script>
  <ul>
    <?php foreach($favoritos as $favorito): ?>
    <li id="<?php echo 'tdh_seccion_favorita_'.$favorito->getId() ?>"><?php echo link_to(image_tag($favorito->getImagen('icon'), array('alt' => $favorito->getNombre())), '@tdh_seccion?seccion_slug='.$favorito->getSlug(), array('title' => $favorito->getNombre())) ?></li>
    <?php endforeach ?>
  </ul>
  <div class="tdh_fix"></div>
  <div class="tdh_apartado">Mis juegos favoritos</div>
</div>
