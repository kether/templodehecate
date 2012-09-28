<?php if($eh_foro_hilo->getCritica()->getVideos()->count() > 0): ?>
<ul class="tdh_videos">
  <?php foreach($eh_foro_hilo->getCritica()->getVideos() as $video): ?>
  <li><?php echo link_to($video->getCode(), '@tdh_critica_video_edit?id='.$video->getId(), array('title' => $video->getComentario())) ?></li>
  <?php endforeach ?>
</ul>
<?php else: ?>
Sin vídeos
<?php endif ?>