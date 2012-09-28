<?php use_helper('Date', 'ehForo') ?>

<?php $sf_response->setTitle('Asuntos de '. $tablon->getNombre().' • '.ehForoConfig::getStatic('nombre')) // title ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array($tablon->getNombre())
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_encabezado">
  <h1><?php echo $tablon->getNombre() ?></h1>
  <div class="eh_foro_tablon_descripcion"><?php echo $tablon->getDescripcion() ?></div>
  <?php if($tablon->getNumSubtablones() > 0): ?>
  <div class="eh_foro_tablon_subtablones">
    <strong>Subtablones:</strong> <?php foreach($subtablones as $key => $subtablon): ?><?php echo ($key == 0 ? '' : ', ').link_to($subtablon->getNombre(), '@eh_foro_tablon?pagina=1&id='.$subtablon->getId(), array('class' => 'eh_foro_subtablon')) ?> <?php endforeach ?>
  </div>
  <?php endif ?>
</div>

<?php if($temas->getResults()->count() > 0): ?>
<div class="eh_foro_opciones">
  <div class="eh_foro_paginas">
    <?php echo $tablon->getNumHilos() ?> temas <?php if($temas->haveToPaginate()): ?> • <?php include_partial('ehForoTema/paginas', array('pager' => $temas, 'uri' => '@eh_foro_tablon?id='.$tablon->getId())) ?><?php endif ?>
  </div>
  
  <?php if($sf_user->isAuthenticated()): ?><?php echo link_to_unless($tablon->esLeido(), 'Marcar todos como leídos', '@eh_foro_leer_tablon?id='.$tablon->getId()) ?><?php endif ?>
</div>

<div id="eh_foro_lista_temas" class="eh_foro_tabla eh_foro_round">
  <span class="eh_foro_top"><span></span></span>
  <table>
    <thead>
      <tr>
        <th class="eh_foro_leido"></th>
        <th class="eh_foro_staff"></th>
        <th class="eh_foro_asunto">Asunto</th>
        <th class="eh_foro_autor">Autor</th>
        <th class="eh_foro_respuestas">RE</th>
        <th class="eh_foro_visto">Leídos</th>
        <th class="eh_foro_ultima_respuesta">Última respuesta</th>
      </tr>
    </thead>
    
    <tbody>
      <?php foreach($temas->getResults() as $key => $tema): ?>
      <tr class="<?php echo $key % 2 == 0 ? 'par' : 'impar' ?>">
        <td class="eh_foro_leido"><?php echo link_to(image_tag(ehForoConfig::getStatic('theme_path').'/images/'.($tema->esLeido() ? 'thread-read.png' : 'thread-no-read.png'), array('alt' => 'Nuevos mensajes')), '@eh_foro_tema?pagina=1&id='.$tema->getId()) ?></td>
        <td class="eh_foro_staff"><?php echo $tema->getEstadoStaff() ? image_tag(ehForoConfig::getStatic('theme_path').'/images/staff.png') : '' ?></td>
        <td class="eh_foro_asunto"><?php echo link_to($tema->getAsunto(), '@eh_foro_tema?pagina=1&id='.$tema->getId()) ?></td>
        <td class="eh_foro_autor"><?php echo link_to_foro_user($tema->getAutor(), $tema->getPrimerMensaje()->getUsuario()) ?></td>
        <td class="eh_foro_respuestas"><?php echo $tema->getRespuestas() ?></td>
        <td class="eh_foro_visto"><?php echo $tema->getLeido() ?></td>
        <td class="eh_foro_ultima_respuesta">
          <?php if($tema->getPrimerMensajeId() != $tema->getUltimoMensajeId()): ?>
          <div class="fecha"><?php echo format_datetime($tema->getUltimoMensaje()->getFechaPublicacion('U'), 'f') ?></div>
          <div class="ultima_respuesta"><?php echo link_to_foro_user($tema->getUltimoMensaje()->getNick(), $tema->getUltimoMensaje()->getUsuario()) ?></div>
          <?php else: ?>
          <div class="ultima_respuesta">Sin respuestas</div>
          <?php endif ?>
        </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <span class="eh_foro_bottom"><span></span></span>
</div>

<div class="eh_foro_opciones">
  <div class="eh_foro_paginas">
    <?php echo $tablon->getNumHilos() ?> temas <?php if($temas->haveToPaginate()): ?> • <?php include_partial('ehForoTema/paginas', array('pager' => $temas, 'uri' => '@eh_foro_tablon?id='.$tablon->getId())) ?><?php endif ?>
  </div>
</div>
<?php endif ?>

<?php include_partial('ehForoTema/botonesLista', array('tablon_id' => $tablon->getId())) ?>