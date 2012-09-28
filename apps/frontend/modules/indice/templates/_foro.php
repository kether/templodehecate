<div id="tdh_foro_plugin">
	<?php use_stylesheet('tdh8_foroplugin') ?>
  <h2>Últimos temas en los foros</h2>
  <ul>
    <?php foreach($foro as $key => $hilo): ?>
    <li class="<?php echo $key % 2 ? 'impar' : 'par' ?>">
      <?php echo link_to($hilo->getPrimerMensaje()->getAsunto(), '@eh_foro_tema?pagina='.$hilo->getUltimaPagina().'&id='.$hilo->getId(), array('title' => 'Enviado por '.$hilo->getAutor())) ?>
      [<?php echo $hilo->getRespuestas() ?>]
    </li>
    <?php endforeach ?>
  </ul>
</div>