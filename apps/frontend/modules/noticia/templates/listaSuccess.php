<?php use_helper('Date', 'ehUtilesRutas') ?>
<?php use_stylesheet('tdh8_listados', 'last') ?>

<?php $sf_response->setTitle('Archivo de noticias • '.sfConfig::get('app_nombre')) ?>
<?php slot('menu_administrador', link_to_app('Editar noticias', 'backend', 'tdh_noticia')) ?>

<?php if($sf_request->hasParameter('seccion_slug')): ?>
<?php slot('submenu_pre', '<li>'.link_to('Noticias de '.$seccion->getNombre(), '@tdh_seccion_noticia_lista?pagina=1&seccion_slug='.$seccion->getSlug()).'</li>') ?>
<?php include_partial('seccion/decorador', array('seccion' => $seccion)) ?>
<?php endif ?>

<?php slot('navegacion') ?>
<?php include_component('noticia', 'medios') ?>
<?php end_slot() ?>

<div id="tdh_noticia_lista" class="tdh_contenido_lista">
  <h1>Archivo de noticias</h1>
  
  <ul>
    <?php foreach($lista->getResults() as $key => $noticia): ?>
    <li class="<?php echo $key % 2 == 0 ? 'tdh_par' : 'tdh_impar' ?>" id="<?php echo 'tdh_noticia_'.$noticia->getId() ?>">
      <div class="tdh_captura">
        <?php echo link_to(image_tag($noticia->getImagePath('peq'), array('alt' => $noticia->getTitular())), $noticia->getRouting(), array('title' => $noticia->getTitular())) ?>
      </div>
      <div class="tdh_detalles">
        <h2><?php echo link_to($noticia->getTitular(), $noticia->getRouting()) ?></h2>
        <div class="tdh_info"><?php echo format_datetime($noticia->getMensaje()->getFechaPublicacion(), 'dddd, dd MMMM yyyy HH:mm') ?></div>
        <div class="tdh_entradilla"><?php echo $noticia->getEntradilla() ? $noticia->getEntradilla() : 'Haz click en el titular para leer los detalles de la noticia.' ?></div>
      </div>
    </li>
    <?php endforeach ?>
  </ul>
</div>

<div class="tdh_paginacion"><?php include_partial('global/paginas', array('pager' => $lista, 'uri' => '@tdh_noticia_lista')) ?></div>