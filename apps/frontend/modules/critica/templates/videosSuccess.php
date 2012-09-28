<?php use_stylesheet('tdh8_layout_b', 'last') ?>
<?php use_stylesheet('tdh8_critica', 'last') ?>
<?php use_stylesheet('jquery.ui.stars.css', 'last') ?>  
<?php use_javascript('jquery.ui.stars-3.0.js', 'last') ?>

<?php $sf_response->setTitle('Vídeos de '.$critica->getTitular().' • '.tdhConfig::get('nombre')) ?>

<div id="tdh_critica_videos">
  <h1><?php echo link_to('Vídeos de '.$critica->getTitular(), $critica->getRouting(), array('title' => $critica->getTitular())) ?></h1>
  
  <ul>
    <?php foreach($critica->getVideos() as $video): ?>
    <li>
      <?php echo $video->getTagHtml() ?>
      <?php if($video->getComentario()): ?><h3><?php echo $video->getComentario() ?></h3><?php endif ?>
    </li>
    <?php endforeach ?>
  </ul>
  
</div>

<?php slot('navegacion') ?>
<!-- Contenidos de navegación -->
<div id="tdh_calificacion">
  <?php include_partial('critica/nota', array('nota' => $nota, 'critica' => $critica)) ?>
</div>

<div class="tdh_capturas tdh_otros_contenidos"> 
  <h2>Multimedia</h2>
  <ul>
    <li><h3><?php echo link_to_if($critica->getNbCapturas() > 0, 'Imágenes ('.$critica->getNbCapturas().')', '@tdh_critica_capturas?id='.$critica->getId()) ?></h3></li>
  </ul>
</div>
<?php end_slot() ?>