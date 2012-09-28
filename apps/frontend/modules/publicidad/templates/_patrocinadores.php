<script type="text/javascript">
$(document).ready(function() { 
  $("#tdh_patrocinadores ul").carouFredSel({
    auto        : { play: true, pauseDuration: 5000 },
    items       : { visible: 5 },
    scroll      : { pauseOnHover: true },
  })
  .delegate('#tdh_patrocinadores li a[title]', 'mouseenter', function() {
    tdhToolTipPatrocinador(this);
  });
});
</script>

<div id="tdh_patrocinadores">
  <ul>
    <?php foreach($patrocinadores as $patrocinador): ?>
    <li><?php echo link_to(image_tag($patrocinador->getRecursoPath(), array('alt' => $patrocinador->getNombre())), '@tdh_publicidad_url?id='.$patrocinador->getId(), array('title' => $patrocinador->getNombre().($patrocinador->getDescripcion() ? ': '.$patrocinador->getDescripcion() : ''))) ?></li>
    <?php endforeach ?>
    
    <?php if($patrocinadores->count() < 5): ?>
    <?php for($i = $patrocinadores->count()-5; $i < 0 ; $i++): ?>
    <li><?php echo link_to(image_tag(tdhConfig::get('img_generica_sponsor'), array('alt' => '¡Patrociname!')), '@tdh_publicidad_promocion', array('title' => '¡Patrocina esta web!')) ?></li>
    <?php endfor ?>
    <?php endif ?>
  </ul>
</div>
