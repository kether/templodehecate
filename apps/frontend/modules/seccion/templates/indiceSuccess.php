<?php use_helper('ehUtiles', 'ehUtilesRutas', 'Number') ?>

<?php foreach($seccion->getHojasDeEstilo() as $hoja) use_stylesheet(url_for('@tdh_css?fichero='.$hoja->getFilename(), 'last', array('title' => $hoja->getTitle(), 'media' => $hoja->getMedia()))) ?>

<?php use_stylesheet('jquery.ui.stars.css', 'last') ?>
<?php use_stylesheet('tdh8_seccion.css', 'last') ?>

<?php use_javascript('jquery.ui.stars-3.0.js', 'last') ?>
<?php use_javascript('jqueryui/jquery.ui.datepicker-es.js') ?>

<?php $sf_response->setTitle($seccion->getNombre(false).' • '.sfConfig::get('app_nombre')) ?>

<?php include_partial('seccion/decorador', array('seccion' => $seccion)) ?>
<?php slot('menu_administrador', link_to_app('Editar ésta sección', 'backend', 'tdh_seccion_edit', array('id' => $seccion->getId()))) ?>
<?php slot('meta_description', $seccion->getDescripcion()) ?>

<script type="text/javascript">$(function(){ tdhFavoritoTooltip(); });</script>

<?php slot('submenu') ?>
<!-- Opciones del submenú -->
<li><?php echo link_to('Noticias', '@tdh_seccion_noticia_lista?pagina=1&seccion_slug='.$seccion->getSlug()) ?></li>
<li><?php echo link_to('Ayudas y módulos', '@tdh_seccion_recurso_lista?pagina=1&seccion_slug='.$seccion->getSlug()) ?></li>
<li><?php echo link_to('Reseñas', '@tdh_seccion_critica_lista?pagina=1&seccion_slug='.$seccion->getSlug()) ?></li>
<li><?php echo link_to('Foros de discusión', '@eh_foro_tablon?pagina=1&id='.$seccion->getTablonId()) ?></li>
<?php end_slot() ?>

<?php slot('extra') ?>
<!-- Ficha técnica -->
<div id="tdh_ficha_tecnica">
  <div class="tdh_portada">
    <?php echo image_tag($seccion->getCoverPath('covmed', true), array('alt' => $seccion->getNombre())) ?>
  </div>
  
  <h1><?php echo $seccion->getNombre() ?></h1>
  
  <h2><?php echo $seccion->getNombreOriginal() ?></h2>
  
  <ul class="tdh_detalles">
    <li><?php echo link_to($seccion->getTipo(), '@tdh_seccion_lista?tipo='.$seccion->getTipo()->getSlug()) ?></li>
    <li><strong>Género:</strong> <?php echo link_to($seccion->getGenero(), '@tdh_seccion_lista?genero='.$seccion->getGenero()->getSlug()) ?></li>
    <li><strong>Editor:</strong> <?php echo $seccion->getEditor() ?></li>
  </ul>
</div>

<?php if($criticas->count() > 0): ?>
<!-- Críticas -->
<div id="tdh_catalogo">
  <h2>Catálogo</h2>
  <ul>
    <?php foreach($criticas as $critica): ?>
    <li id="<?php echo 'critica_'.$critica->getId() ?>">
      <div class="tdh_cubierta"><?php echo link_to(image_tag($critica->getCoverPath('covpeq'), array('alt' => $critica->getTitular())), $critica->getRouting()) ?></div>
      
      <div class="tdh_detalles">
        <h3><?php echo link_to($critica->getTitular(), $critica->getRouting()) ?></h3>
        <div class="tdh_informacion">
          <span class="tdh_basico"><?php echo $critica->getEstadoBasico() ? 'Básico' : 'Expansión' ?></span>
          —
          <span class="tdh_nota"><?php echo $critica->getEstadoSinNota() ? 'ND' : format_number(number_format($critica->getNota(), 2)) ?></span>
          <?php if($sf_user->esColaborador($sf_request->getParameter('seccion_slug'))): ?>
            <div class="tdh_opciones_colaborador">
              <a href="<?php echo url_for_app('backend', 'tdh_critica_edit', array('id' => $critica->getHiloId())) ?>" onclick="tdhAddRecursoSeccion('<?php echo url_for('@tdh_seccion_nueva_critica?contenido_id='.$critica->getHiloId().'&seccion_slug='.$sf_request->getParameter('seccion_slug')) ?>', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;"><span>Editar</span></a>
            </div>
          <?php endif ?>
        </div>
      </div>
    </li>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>

<?php end_slot() ?>

<?php slot('navegacion') ?>
<?php if($criticaBasica): ?>
<div id="tdh_calificacion">
  <?php include_partial('critica/nota', array('nota' => $nota, 'critica' => $criticaBasica))  ?>
</div>
<?php endif ?>

<div id="tdh_foro_plugin">
	<?php use_stylesheet('tdh8_foroplugin') ?>
  <h2>Últimos temas en los foros</h2>
  <ul>
    <?php foreach($foro as $key => $hilo): ?>
    <li class="<?php echo $key % 2 ? 'impar' : 'par' ?>">
      <?php echo link_to($hilo->getPrimerMensaje()->getAsunto(), '@eh_foro_tema?pagina=1&id='.$hilo->getId(), array('title' => 'Enviado por '.$hilo->getAutor())) ?>
      [<?php echo $hilo->getRespuestas() ?>]
    </li>
    <?php endforeach ?>
  </ul>
</div>

<?php if($colaboradores->count() > 0): ?>
<div id="tdh_colaboradores">
  <script type="text/javascript">$(document).ready(function() { $('#tdh_colaboradores li a[title]').qtip({overwrite: false, style: { classes: 'ui-tooltip-blue ui-tooltip-tipsy' } }); });</script>
  <h2>Colaboradores</h2>
  <ul>
    <?php foreach($colaboradores as $colaborador): ?>
    <li><?php echo link_to(image_tag($colaborador->getPerfil()->getAvatarMiniPath(), array('alt' => $colaborador->getNick())), '@eh_foro_perfil?username='.$colaborador->getUsername(), array('title' => $colaborador->getNick())) ?></li>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>
<?php end_slot() ?>

<div id="tdh_seccion">
   
  <div id="tdh_noticias" class="tdh_contenido">
    <div id="tdh_favorito_seccion"><?php include_partial('seccion/favorito', array('seccion_id' => $seccion->getId(), 'es_favorito' => $seccion->getEsMiFavorito($sf_user->getUserId()))) ?></div>
    <h2 style="background-image: url('<?php echo $seccion->getImagen('defecto') ?>');">
      Noticias y novedades
    </h2>
    
    <ul>
      <?php if($noticias->count() > 0): ?>
      <?php foreach($noticias as $noticia): ?>
      <li id="<?php echo 'noticia'.$noticia->getId() ?>">
        <div class="tdh_imagen"><?php echo link_to(image_tag($noticia->getImagePath('peq'), array('alt' => $noticia->getTitular())), $noticia->getRouting()) ?></div>
        
        <div class="tdh_detalle">
          <h3><?php echo link_to($noticia->getTitular(), $noticia->getRouting()) ?></h3>
          <div class="tdh_entradilla"><?php echo $noticia->getEntradilla() ?></div>
          <?php if($sf_user->esColaborador($sf_request->getParameter('seccion_slug'))): ?>
            <div class="tdh_opciones_colaborador">
              <a href="<?php echo url_for_app('backend', 'tdh_noticia_edit', array('id' => $noticia->getHiloId())) ?>" onclick="tdhAddRecursoSeccion('<?php echo url_for('@tdh_seccion_nueva_noticia?contenido_id='.$noticia->getHiloId().'&seccion_slug='.$sf_request->getParameter('seccion_slug')) ?>', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;"><span>Editar</span></a>
            </div>
          <?php endif ?>
          <div class="tdh_fix"></div>
        </div>
      </li>
      <?php endforeach ?>
      <?php else: ?>
      <li>
        <h3>Nada por el momento</h3>
        <div class="tdh_entradilla">No tenemos ninguna noticia para <?php echo $seccion ?> que mostrar.</div>
      </li>
      <?php endif ?>
       <?php if($sf_user->isAuthenticated()): ?>
      <li id="tdh_formulario_recurso" style="display: none;"></li>
      <li class="tdh_colaboradores">
        <div class="tdh_add_loader"></div>
        <div class="tdh_add_contenidos">
          Añadir <?php echo link_to_app('noticia', 'backend', 'tdh_noticia_new', array('seccion_id' => $seccion->getId()), array('onclick' => "tdhAddRecursoSeccion('".url_for('@tdh_seccion_nueva_noticia?seccion_slug='.$sf_request->getParameter('seccion_slug'))."', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;")) ?>,
          <?php echo link_to_app('recurso', 'backend', 'tdh_recurso_new', array('seccion_id' => $seccion->getId()), array('onclick' => "tdhAddRecursoSeccion('".url_for('@tdh_seccion_nuevo_recurso?seccion_slug='.$sf_request->getParameter('seccion_slug'))."', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;")) ?> o
          <?php echo link_to_app('crítica', 'backend', 'tdh_critica_new', array('seccion_id' => $seccion->getId()), array('onclick' => "tdhAddRecursoSeccion('".url_for('@tdh_seccion_nueva_critica?seccion_slug='.$sf_request->getParameter('seccion_slug'))."', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;")) ?>
          a <?php echo $seccion->getNombre() ?>
        </div>
      </li>
      
      <?php if($sf_user->esColaborador($sf_request->getParameter('seccion_slug'))): ?>
      <?php foreach($noticiasDes as $contenido): ?>
      <li class="tdh_contenido_por_aprobar">
        <a href="<?php echo url_for_app('backend', 'tdh_noticia_edit', array('id' => $contenido->getHiloId())) ?>" onclick="tdhAddRecursoSeccion('<?php echo url_for('@tdh_seccion_nueva_noticia?contenido_id='.$contenido->getHiloId().'&seccion_slug='.$sf_request->getParameter('seccion_slug')) ?>', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;"><?php echo $contenido->getTitular() ?></a> (Noticia enviada por <?php echo link_to($contenido->getMensaje()->getUsuario()->getNick(), '@eh_foro_perfil?username='.$contenido->getMensaje()->getUsuario()->getUsername()) ?>)
      </li>
      <?php endforeach ?>
      <?php foreach($criticasDes as $contenido): ?>
      <li class="tdh_contenido_por_aprobar">
        <a href="<?php echo url_for_app('backend', 'tdh_critica_edit', array('id' => $contenido->getHiloId())) ?>" onclick="tdhAddRecursoSeccion('<?php echo url_for('@tdh_seccion_nueva_critica?contenido_id='.$contenido->getHiloId().'&seccion_slug='.$sf_request->getParameter('seccion_slug')) ?>', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;"><?php echo $contenido->getTitular() ?></a> (Crítica enviada por <?php echo link_to($contenido->getMensaje()->getUsuario()->getNick(), '@eh_foro_perfil?username='.$contenido->getMensaje()->getUsuario()->getUsername()) ?>)
      </li>
      <?php endforeach ?>
      <?php foreach($recursosDes as $contenido): ?>
      <li class="tdh_contenido_por_aprobar">
        <a href="<?php echo url_for_app('backend', 'tdh_recurso_edit', array('id' => $contenido->getHiloId())) ?>" onclick="tdhAddRecursoSeccion('<?php echo url_for('@tdh_seccion_nuevo_recurso?contenido_id='.$contenido->getHiloId().'&seccion_slug='.$sf_request->getParameter('seccion_slug')) ?>', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;"><?php echo $contenido->getTitular() ?></a> (Recurso enviado por <?php echo link_to($contenido->getMensaje()->getUsuario()->getNick(), '@eh_foro_perfil?username='.$contenido->getMensaje()->getUsuario()->getUsername()) ?>)
      </li>
      <?php endforeach ?>
      <?php endif  ?>
      
      <?php endif ?>
    </ul>
  </div>
  
  <?php if($recursos->count() > 0): ?>
  <div id="tdh_recursos" class="tdh_contenido">
    <h2>Ayudas y módulos</h2>
    <ul>
      <?php foreach($recursos as $recurso): ?>
      <li id="<?php echo 'recurso'.$recurso->getId() ?>">
        <h3><?php echo link_to($recurso->getTitular(), $recurso->getRouting()) ?></h3>
        <div class="tdh_entradilla"><?php echo $recurso->getEntradilla() ?></div>
        <?php if($sf_user->esColaborador($sf_request->getParameter('seccion_slug'))): ?>
        <div class="tdh_opciones_colaborador">
          <a href="<?php echo url_for_app('backend', 'tdh_recurso_edit', array('id' => $recurso->getHiloId())) ?>" onclick="tdhAddRecursoSeccion('<?php echo url_for('@tdh_seccion_nuevo_recurso?contenido_id='.$recurso->getHiloId().'&seccion_slug='.$sf_request->getParameter('seccion_slug')) ?>', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;"><span>Editar</span></a>
        </div>
        <?php endif ?>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
  <?php endif ?>
  
</div>