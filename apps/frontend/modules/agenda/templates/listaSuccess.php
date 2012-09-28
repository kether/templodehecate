<?php use_helper('Date') ?>
<?php slot('menu_administrador', link_to_app('Editar eventos', 'backend', 'tdh_evento')) ?>

<?php use_javascript('jqueryui/jquery.ui.datepicker-es.js') ?>

<?php use_stylesheet('tdh8_listados.css', 'last') ?>

<?php $sf_response->setTitle('Eventos • '.tdhConfig::get('nombre')) ?>

<div id="tdh_evento_lista" class="tdh_contenido_lista">
  <h1>Archivo de eventos</h1>
  
  <?php if($sf_user->isAuthenticated()): ?>
  <?php use_stylesheet('tdh8_form_evento.css', 'last') ?>
  <div id="tdh_add_recurso">
    <div class="tdh_add_loader"></div>
    <?php echo link_to('Añadir un nuevo evento', '@tdh_evento_nuevo', array('onclick' => "tdhAddRecursoSeccion('".url_for('@tdh_evento_nuevo')."', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;")) ?>
  </div>
  <div id="tdh_formulario_recurso"></div>
  <?php endif ?>
  
  <ul>
    <?php foreach($lista->getResults() as $evento): ?>
    <li id="<?php echo 'evento'.$evento->getId() ?>">
      <div class="tdh_fecha">
        <div class="tdh_mes"><?php echo format_date($evento->getFechaInicio(), 'MMM') ?></div>
        <div class="tdh_dia"><?php echo format_date($evento->getFechaInicio(), 'dd') ?></div>
      </div>
      <h2><?php echo link_to($evento->getTitular(), $evento->getRouting()) ?></h2>
      <div class="tdh_localizacion"><?php echo $evento->getDireccionCorta() ?></div>
      
    </li>
    <?php endforeach ?>
  </ul>
</div>

<div class="tdh_paginacion"><?php include_partial('global/paginas', array('pager' => $lista, 'uri' => '@tdh_evento_lista')) ?></div>