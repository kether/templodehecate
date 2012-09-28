<?php $sf_context->getResponse()->setTitle('Grupo: '.$grupo->getNombre().' • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array('Grupos', '@eh_foro_grupos?pagina=1'),
    array($grupo->getNombre())
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_grupo">
  
  <h1><?php echo $grupo->getNombre() ?></h1>
  
  <div class="eh_foro_opciones">Opciones</div>
  
  <div class="eh_foro_cuerpo">
    <?php echo $grupo->getDescripcionHtml() ?>
  </div>
  
</div>