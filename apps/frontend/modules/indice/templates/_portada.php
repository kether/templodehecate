<?php if($destacados->count() > 0): ?>
<div id="tdh_portada_titulares_graficos">  
  <script type="text/javascript">
  $(document).ready(function(){ 
    $("#tdh_slider ul").carouFredSel({
      auto        : { play: true, pauseDuration: 6000 },
      items       : { visible: 1 },
      scroll      : { pauseOnHover: true, fx: 'crossfade' },
    });

    $("#tdh_slider li").click(function() {
      $(location).attr('href', $(this).contents().children('h1').children('a').attr('href'));
    });
  });
  </script>
  
  <div id="tdh_slider">
    <ul>
      <?php foreach($destacados as $destacado): ?>
      <li id="<?php echo 'tdh_noticia_destacada_'.$destacado->getId() ?>" style="background-image: url('<?php echo image_path($destacado->getImagePath('med')) ?>');">
        <div class="tdh_solapa">
          <h1><?php echo link_to(cadena_truncada($destacado->getTitular(), 40), $destacado->getRouting(), array('title' => $destacado->getTitular())) ?></h1>
          <div class="tdh_entradilla"><?php echo cadena_truncada($destacado->getEntradilla(), 65) ?></div>
        </div>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
  
  <div id="tdh_portada_mini_titulares">
    <ul>
      <?php foreach($destacados as $destacado): ?>
      <li>
        <?php echo link_to(image_tag($destacado->getImagePath('peq'), array('alt' => $destacado->getTitular())), '@homepage#tdh_noticia_destacada_'.$destacado->getId(), array('class' => 'caroufredsel', 'title' => $destacado->getTitular())) ?>
        <p><?php echo cadena_truncada($destacado->getTitular(), 26) ?></p>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>
<?php endif ?>

<?php if($noticias->count() > 0): ?>
<div id="tdh_noticias">
  <ul>
    <?php foreach($noticias as $noticia): ?>
    <li>
      <h2><?php echo link_to($noticia->getTitular(), $noticia->getRouting()) ?></h2>
      <div class="info">
        <?php echo link_to($noticia->getMensaje()->getNick(), '@eh_foro_perfil?username='.$noticia->getMensaje()->getUsuario()) ?> el
        <?php echo format_datetime($noticia->getMensaje()->getFechaPublicacion(), 'f') ?>
      </div>
      <div class="tdh_entradilla"><p><?php echo $noticia->getEntradilla() ?></p></div>
    </li>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>