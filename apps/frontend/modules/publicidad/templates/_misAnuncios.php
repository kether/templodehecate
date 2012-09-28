<div class="tdh_otros_contenidos">
  <h2>Mis promociones</h2>
  <ul>
    <?php foreach($anuncios as $anuncio): ?>
    <li>
      <h3><?php echo link_to($anuncio->getNombre(), '@tdh_publicidad_mostrar?id='.$anuncio->getId()) ?></h3>
    </li>
    <?php endforeach ?>
  </ul>
</div>