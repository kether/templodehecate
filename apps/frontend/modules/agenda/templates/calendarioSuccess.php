<?php use_stylesheet('tdh8_calendario', 'last') ?>
<?php use_stylesheet('tdh8_navegador_eventos', 'last') ?>

<?php use_javascript('tdh.calendario.js', 'last') ?>
<?php use_javascript('jqueryui/jquery.ui.datepicker-es.js') ?>

<?php slot('menu_administrador', link_to_app('Editar eventos', 'backend', 'tdh_evento')) ?>

<?php $sf_context->getResponse()->setTitle('Calendario • '.sfConfig::get('app_nombre')) ?>

<?php slot('navegacion') ?>
<div id="tdh_navegador_eventos">
  <?php include_component('agenda', 'eventos') ?>
</div>
<?php end_slot() ?>

<div id="tdh_calendario_marco">
  <div id="tdh_calendario">
    <?php include_partial('agenda/mes', array('calendario' => $calendario)) ?>
  </div>
</div>

<?php if($sf_user->isAuthenticated()): ?>
  <?php use_stylesheet('tdh8_form_evento.css', 'last') ?>
  <div id="tdh_add_recurso">
    <div class="tdh_add_loader"></div>
    <?php echo link_to('Añadir un nuevo evento', '@tdh_evento_nuevo', array('onclick' => "tdhAddRecursoSeccion('".url_for('@tdh_evento_nuevo')."', '#tdh_formulario_recurso', '.tdh_add_loader'); return false;")) ?>
  </div>
  <div id="tdh_formulario_recurso"></div>
<?php endif ?>