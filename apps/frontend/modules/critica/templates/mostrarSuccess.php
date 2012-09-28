<?php use_helper('Date', 'ehUtiles', 'Number', 'ehUtilesRutas', 'I18N') ?>

<?php use_stylesheet('tdh8_contenidos', 'last') ?>
<?php use_stylesheet('tdh8_critica', 'last') ?>
<?php use_stylesheet('jquery.ui.stars.css', 'last') ?>

<?php use_javascript('jquery.ui.stars-3.0.js', 'last') ?>

<?php $sf_response->setTitle($critica->getTitular().' • '.tdhConfig::get('nombre')) ?>
<?php slot('menu_administrador', link_to_app('Editar reseña', 'backend', 'tdh_critica_edit', array('id' => $critica->getHilo()->getId()))) ?>

<?php if($sf_request->hasParameter('seccion_slug')): ?>
<?php slot('submenu_pre', '<li>'.link_to('Reseñas de '.$critica->getSeccion()->getNombre(), '@tdh_seccion_critica_lista?pagina=1&seccion_slug='.$critica->getSeccion()->getSlug()).'</li>') ?>
<?php include_partial('seccion/decorador', array('seccion' => $critica->getSeccion())) ?>
<?php endif ?>

<?php slot('extra') ?>
<!-- Contenidos extras -->
<div id="tdh_critica_portada">
  <?php echo image_tag($critica->getCoverPath(), array('alt' => $critica->getTitular())) ?>
</div>

<div id="tdh_critica_seccion">
  <?php echo $critica->getSeccion()->getTipo()->getEsJuego() ? link_to($critica->getSeccion()->getNombre(), '@tdh_seccion?seccion_slug='.$critica->getSeccion()->getSlug()) : $critica->getTitular() ?>
</div>

<div id="tdh_critica_ficha_tecnica">
  <ul>
    <?php if($critica->getSeccion()->getTipo()->getEsJuego()): ?>
    <li><?php echo link_to($critica->getEditor(), '@tdh_editor?slug='.$critica->getEditor()->getSlug()) ?></li>
    <li><?php echo link_to($critica->getSeccion()->getGenero(), '@tdh_genero?slug='.$critica->getSeccion()->getGenero()->getSlug()) ?></li>
    <?php else: ?>
    <li><?php echo $critica->getSeccion()->getNombre() ?></li>
    <?php endif ?>
    <?php if($critica->getAutor()): ?><li>Autor: <span class="tdh_dato"><?php echo $critica->getAutor() ?></span></li><?php endif ?>
    <?php if($critica->getPaginas() > 0): ?><li>Páginas: <span class="tdh_dato"><?php echo $critica->getPaginas() ?></span></li><?php endif ?>
    <li>Idioma: <span class="tdh_dato tdh_idioma"><?php echo format_language($critica->getIdioma()) ?></span></li>
    <li>Salida: <span class="tdh_dato"><?php echo is_null($critica->getFechaPublicacion()) ? 'Desconocida' : format_datetime(strtotime($critica->getFechaPublicacion()), 'dd/MM/yyyy') ?></span></li>
    <?php if($critica->getPrecio() >= 0): ?><li>PVP*: <span class="tdh_dato"><?php echo $critica->getPrecio() > 0 ? format_currency($critica->getPrecio(), $critica->getMoneda()) : 'Gratuito' ?></span></li><?php endif ?>
  </ul>
</div>

<?php end_slot() ?>

<?php slot('navegacion') ?>
<!-- Contenidos de navegación -->
<div id="tdh_calificacion">
  <?php include_partial('critica/nota', array('nota' => $nota, 'critica' => $critica)) ?>
</div>

<div class="tdh_capturas tdh_otros_contenidos">
  <h2>Multimedia</h2>
  <ul>
    <li><h3><?php echo link_to_if($critica->getNbCapturas() > 0, 'Imágenes ('.$critica->getNbCapturas().')', '@tdh_critica_capturas?id='.$critica->getId()) ?></h3></li>
    <li><h3><?php echo link_to_if($critica->getVideos()->count() > 0, 'Videos ('.$critica->getVideos()->count().')', '@tdh_critica_videos?id='.$critica->getId()) ?></h3></li>
  </ul>
</div>

<?php if($otros->count() > 0): ?>
<div class="tdh_otros_contenidos">
  <h2>Otras reseñas</h2>
  <ul>
    <?php foreach($otros as $otro): ?>
    <li>
      <h3><?php echo link_to($otro->getTitular(), $otro->getRouting()) ?></h3>
      <div class="tdh_fecha"><?php echo format_datetime($otro->getMensaje()->getFechaPublicacion(), 'F') ?></div>
    </li>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>
<?php end_slot() ?>

<div id="tdh_critica" class="tdh_contenido">
  <h1><?php echo $critica->getTitular() ?></h1>
  <div class="tdh_seccion">
    Enviado por <?php echo link_to($critica->getMensaje()->getUsuario()->getNick(), '@eh_foro_perfil?username='.$critica->getMensaje()->getUsuario()) ?> 
    con fecha <?php echo format_datetime($critica->getMensaje()->getFechaPublicacion(), 'dd/MM/yyyy HH:mm') ?> 
  </div>
  
  <?php if($noticia->getEntradilla() && $sf_request->getParameter('pag', 1) == 1):?>
  <?php slot('meta_description', $noticia->getEntradilla()) ?>
  <div class="tdh_entradilla">
    <?php echo $noticia->getEntradilla() ?>
  </div>
  <?php endif ?>
  
  <!-- Cuerpo del contenido -->
  <div class="tdh_cuerpo"><?php echo $critica->getMensaje()->getCuerpoHtmlDividido($sf_request->getParameter('pag', 1)) ?></div>
  
  <?php include_partial('global/paginasContenido', array('paginador' => $critica->getMensaje()->getPaginadorContenido(), 'ruta' => $critica->getRouting().'&pag=')) ?>
  
  <?php include_partial('seccion/compartir', array('url' => url_for($critica->getRouting(), true))) ?>
</div>

<div id="tdh_comentarios">
  <?php include_partial('seccion/comentarios', array('hilo' => $critica->getHilo())) ?>
</div>