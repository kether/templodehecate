<?php if($populares->count() > 0): ?>
<div id="tdh_ranking">
  <script type="text/javascript">
  $(document).ready(function(){ 
    $("#tdh_ranking li").click(function() {
      $(location).attr('href', $(this).contents().children('a').attr('href'));
    });
  });
  </script>
  
  <div class="tdh_titulo">Juegos populares</div>
  <ul>
    <?php foreach($populares as $key => $juego): ?>
    <li class="<?php echo $key % 2 > 0 ? 'impar' : 'par' ?>">
      <?php echo image_tag($juego->getCoverPath('covpeq'), array('alt' => $juego->getNombre(), 'class' => 'cover')) ?>
      <h2><?php echo $key+1 ?>. <?php echo link_to(cadena_truncada($juego->getNombre(), 20), '@tdh_seccion?seccion_slug='.$juego->getSlug(), array('title' => $juego->getNombre())) ?></h2>
      <div class="info"><?php echo $juego->getTipo() ?> • <?php echo $juego->getGenero() ?></div>
    </li>
    <?php endforeach ?>
  </ul>
  <div class="tdh_info">Elaborado con los datos de visita</div>
</div>
<?php endif ?>