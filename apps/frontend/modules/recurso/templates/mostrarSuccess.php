<?php use_helper('Date', 'ehUtiles', 'Number') ?>

<?php use_stylesheet('blitzer/jquery-ui', 'last') ?>
<?php use_stylesheet('tdh8_contenidos', 'last') ?>

<?php tdh_set_title($recurso->getTipo().': '.$recurso->getTitular()) ?>

<?php echo slot('menu_administrador', link_to_app('Editar en el administrador', 'backend', 'tdh_recurso_edit', array('id' => $recurso->getHilo()->getId()))) ?>

<?php if($sf_request->hasParameter('seccion_slug')): ?>
<?php slot('submenu_pre', '<li>'.link_to('Recursos de '.$recurso->getSeccion()->getNombre(), '@tdh_seccion_recurso_lista?pagina=1&seccion_slug='.$recurso->getSeccion()->getSlug()).'</li>') ?>
<?php include_partial('seccion/decorador', array('seccion' => $recurso->getSeccion())) ?>
<?php endif ?>

<?php slot('meta_copyright', $recurso->getLicencia()) ?>

<script type="text/javascript">
$(document).ready(function() {
  $('.tdh_donacion .radio_list').buttonset();
  tdhTooltip('li.tdh_donaciones[title]', 'left center', 'right center');
});
</script>

<?php slot('extra') ?>
<div class="tdh_informacion">
  <?php if($recurso->hasImage('covmed')): ?>
  <div class="tdh_cover"><?php echo link_to_if($recurso->hasPdf(), image_tag($recurso->getImagePath('covmed'), array('alt' => $recurso->getTitular())), $recurso->getPdfPath()) ?></div>
  <?php endif ?>
  
  <ul>
    <?php if($recurso->getAutor()): ?>
      <?php slot('meta_author', $recurso->getAutor()) ?>
      <li>autor: <?php echo $recurso->getContactoAutor() ? '<a href="'.$recurso->getContactoAutor().'">'.$recurso->getAutor().'</a>' : $recurso->getAutor() ?></li>
    <?php endif ?>
    <li>enviado por: <?php echo link_to($recurso->getMensaje()->getNick(), '@eh_foro_perfil?username='.$recurso->getMensaje()->getUsuario()) ?></li>
    <?php if($noticia->getNombreFuente()): ?>
    <li>fuente: <?php try { echo $noticia->getUrlFuente() ? link_to($noticia->getNombreFuente(), $noticia->getUrlFuente()) : $noticia->getNombreFuente(); } catch(sfException $e) { echo $noticia->getNombreFuente(); } ?></li>
    <?php endif ?>
    <?php if($recurso->getAceptaDonativos()): ?>
    <li class="tdh_donaciones" onclick="$('.tdh_donacion').slideToggle('fast');" title="¡Haz un donativo!">donaciones: <?php echo $recurso->getNumDonativos().($sf_user->isAdministrador() ? ' ('.format_currency($recurso->getCantidadDonativos(), 'EUR').')': '') ?></li>
    <?php endif ?>
    <li>licencia: <?php echo $recurso->getLicencia() ?></li>
  </ul>
</div>

<?php if($recurso->getMensaje()->getTieneAdjuntos()): ?>
<div class="tdh_descargas">
  <ul>
    <?php foreach($recurso->getMensaje()->getAdjuntos() as $archivo): ?>
    <li>
      <h3><?php echo link_to(cadena_truncada($archivo->getNombreArreglado(), 30), $archivo->getRouting()) ?></h3>
      <div class="tdh_descarga_info"><?php echo ceil($archivo->getFicheroSize()/1024) ?> kbytes (<?php echo $archivo->getNumeroDescargas() ?> descargas)</div>
    </li>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>
<?php end_slot() ?>

<?php slot('navegacion') ?>

<div class="tdh_otras_opciones">
  <ul>
    <?php if($recurso->getSeccion()->getTipo()->getEsJuego()): ?><li class="tdh_enrutar"><?php echo link_to('Ir a sección de '.$recurso->getSeccion(), $recurso->getSeccion()->getRouting()) ?></li><?php endif ?>
    <li class="tdh_enrutar"><?php echo link_to('Ver en el foro', sprintf('@eh_foro_tema?pagina=1&id=%s', $recurso->getHilo()->getId())) ?></li>
    <?php if($recurso->esAutorizadoParaEditar($sf_user)): ?>
      <li class="tdh_editar"><?php echo link_to('Editar recurso', '@eh_foro_mensaje_editar?mensaje_id='.$recurso->getHilo()->getPrimerMensaje()->getId()) ?></li>
      <li class="tdh_descargas"><?php echo link_to('Añadir y/o modificar adjuntos', '@eh_foro_cargar_ficheros?mensaje_id='.$recurso->getHilo()->getPrimerMensaje()->getId()) ?></li>
    <?php endif ?>    
  </ul>
</div>

<?php if($recurso->getAceptaDonativos()): ?>
<div class="tdh_donacion">
  <p>
    Si te ha gustado éste recurso y quieres incentivar al autor puedes hacer una pequeña donación. Además te quitaremos la publicidad* de la web durante un mes sea cual sea la cantidad que dones.
    <strong><?php echo tdhConfig::get('nombre') ?></strong> no se queda con ninguna comisión por esta transacción.
  </p>
  
    <form action="<?php echo $paypal->getPaypalUrl() ?>" method="post">
    <fieldset>
    <?php echo $donacion_form->renderHiddenFields() ?>
      <ul>
        <li><?php echo $donacion_form['amount']->render() ?></li>
        <li class="tdh_boton"><input type="image" src="<?php echo image_path('btns/donar.gif') ?>" id="paypal_button" name="paypal_button" /></li>
      </ul>
    </fieldset>
    </form>
  </div>
<?php endif ?>

<?php if($otros->count()): ?>
<div class="tdh_otros_contenidos">  
  <h2>Recursos relacionados</h2>
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

<?php slot('meta_description', $recurso->getEntradilla()) ?>

<div id="tdh_recurso" class="tdh_contenido">
  <h1><?php echo $recurso->getTitular() ?></h1>
  
  <div class="tdh_subtitulo">
    <div class="tdh_seccion"><?php echo $recurso->getTipo() ?> <?php if($recurso->getSeccion()->getTipo()->getEsJuego()): ?>para <?php echo link_to($recurso->getSeccion(), '@tdh_seccion?seccion_slug='.$recurso->getSeccion()->getSlug()) ?><?php endif ?></div>
    <div class="tdh_fecha"><?php echo format_datetime($recurso->getMensaje()->getFechaPublicacion(), 'dddd, dd MMMM yyyy HH:mm') ?></div>
  </div>
  
  <?php if($noticia->getEntradilla()):?>
  <div class="tdh_entradilla">
    <?php echo $noticia->getEntradilla() ?>
  </div>
  <?php endif ?>
  
  <!-- En otros formatos -->
  <?php if($recurso->hasPdf()): ?><div class="tdh_pdf tdh_otro_formato"><?php echo link_to('Descargar en PDF', $recurso->getPdfPath()) ?></div><?php endif ?>
  <?php if($recurso->hasEPub()): ?><div class="tdh_epub tdh_otro_formato"><?php echo link_to('Descargar en ePub', $recurso->getEPubPath()) ?></div><?php endif ?>
  
  <!-- Cuerpo del contenido -->
  <div class="tdh_cuerpo"><?php echo $recurso->getMensaje()->getCuerpoHtml() ?></div>
  
  <?php include_partial('seccion/compartir', array('url' => url_for($recurso->getRouting(), true))) ?>  
</div>

<div id="tdh_comentarios">
  <?php include_partial('seccion/comentarios', array('hilo' => $recurso->getHilo())) ?>
</div>