<?php use_stylesheet('tdh8_layout_b', 'last') ?>
<?php use_stylesheet('tdh8_critica', 'last') ?>
<?php use_stylesheet('jquery.ui.stars.css', 'last') ?>  
<?php use_javascript('galleria/galleria-1.2.5.min.js', 'last') ?>
<?php use_javascript('jquery.ui.stars-3.0.js', 'last') ?>

<?php $sf_response->setTitle('Capturas de '.$critica->getTitular().' • '.tdhConfig::get('nombre')) ?>

<?php slot('menu_administrador', link_to_app('Editar reseña', 'backend', 'tdh_critica_edit', array('id' => $critica->getHilo()->getId()))) ?>

<script>
Galleria.loadTheme('/js/galleria/themes/classic/galleria.classic.min.js');
$(document).ready(function(){ 
  $('#tdh_galeria').galleria({
    width: 652,
    height: 400,
    imagePan: true
  });
});
</script>

<div id="tdh_critica_capturas">
  <h1><?php echo link_to('Capturas de '.$critica->getTitular(), $critica->getRouting(), array('title' => $critica->getTitular())) ?></h1>  
  
  <div id="tdh_galeria">
    <?php foreach($critica->getCapturas() as $captura): ?>
    <?php echo link_to_if(
      $captura->getTamMed(), 
      image_tag($captura->getPath('p'), array('title' => $critica->getTitular(), 'alt' => $captura->getComentario())), 
      image_path($captura->getPath('m')), 
      $captura->getTamGra() ? array('rel' => $captura->getPath('g')) : array()) ?>
    <?php endforeach ?>
  </div>
</div>

<?php slot('navegacion') ?>
<!-- Contenidos de navegación -->
<div id="tdh_calificacion">
  <?php include_partial('critica/nota', array('nota' => $nota, 'critica' => $critica)) ?>
</div>

<div class="tdh_capturas tdh_otros_contenidos"> 
  <h2>Multimedia</h2>
  <ul>
    <li><h3><?php echo link_to_if($critica->getVideos()->count() > 0, 'Videos ('.$critica->getVideos()->count().')', '@tdh_critica_videos?id='.$critica->getId()) ?></h3></li>
  </ul>
</div>
<?php end_slot() ?>