<?php use_helper('ehUtiles', 'Date') ?>

<?php use_stylesheet('tdh8_portada') ?>

<?php $sf_response->setTitle(tdhConfig::get('nombre').' • '.tdhConfig::get('lema')) ?>

<?php slot('socialplus') ?>
<div id="tdh_socialplus">
  <!-- Google+ -->
  <g:plusone size="small" count="false" href="<?php echo url_for('@homepage', true) ?>"></g:plusone>
</div>
<?php end_slot() ?>

<?php include_component('indice', 'portada') ?>

<?php slot('navegacion') ?>
<?php if(isset($favoritos) && $favoritos->count() > 0) include_partial('indice/favoritos', array('favoritos' => $favoritos)) ?>

<div id="tdh_navegador_eventos">
  <?php include_component('agenda', 'eventos') ?>
</div>

<?php include_component('indice', 'foro') ?>
<?php end_slot() ?>

<?php slot('extra') ?>
<?php include_component('indice', 'juegosPopulares') ?>
<?php end_slot() ?>