<?php use_helper('Date') ?>
<?php use_javascript(ehForoConfig::getStatic('theme_path').'/js/jquery.ehforoplugin.js') ?>

<?php $sf_response->setTitle('Mensajes privados recibidos • '.ehForoConfig::getStatic('nombre')) ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => array(
    array('Mensajes recibidos')
  ))); ?>
<?php end_slot() ?>

<div id="eh_foro_encabezado">
  <h1>Mensajes privados recibidos</h1>
</div>

<div class="eh_foro_botones">
  <?php echo link_to(image_tag(ehForoConfig::getStatic('theme_path').'/images/btn-sended.png', array('Mensajes enviados')), '@eh_foro_privados_enviados?pagina=1') ?>
</div>

<div class="eh_foro_opciones">
  <?php include_partial('ehForoMensajePrivado/paginas', array('pager' => $pager, 'uri' => '@eh_foro_privados_recibidos')) ?>
</div>

<div id="eh_foro_privados_recibidos" class="eh_foro_tabla eh_foro_round eh_foro_privados">
  <span class="eh_foro_top"><span></span></span>
  
  <table>
    <thead>
      <tr>
        <th class="eh_foro_leido"></th>
        <th class="eh_foro_borrar"></th>
        <th class="eh_foro_asunto">Asunto</th>
        <th class="eh_foro_remitente">Remitente</th>
        <th class="eh_foro_fecha">Fecha recibido</th>
      </tr>
    </thead>
    <tbody>
      <?php if($pager->getNbResults() < 1): ?>
      <tr>
        <td colspan="4">No tienes mensajes privados recibidos.</td>
      </tr>
      <?php else: ?>
      <?php foreach($pager->getResults() as $key => $registro): ?>
      <tr class="<?php echo $key % 2 == 0 ? 'par' : 'impar' ?>" id="<?php echo 'eh_foro_privado_'.$registro->getId() ?>">
        <td class="eh_foro_leido"><?php echo link_to($registro->getEstadoLeido() ? image_tag(ehForoConfig::getStatic('theme_path').'/images/mail-open.png', array('alt' => 'Leído')) : image_tag(ehForoConfig::getStatic('theme_path').'/images/mail-close.png', array('alt' => 'No leído')), '@eh_foro_privados_mostrar?privado_id='.$registro->getId()) ?></td>
        <td class="eh_foro_borrar"><a href="<?php echo url_for('@eh_foro_privados_borrar?privado_id='.$registro->getId()) ?>" onclick="efpBorrarPrivado('<?php echo url_for('@eh_foro_privados_borrar?privado_id='.$registro->getId()) ?>', '<?php echo '#eh_foro_privado_'.$registro->getId() ?>'); return false;"><?php echo image_tag(ehForoConfig::getStatic('theme_path').'/images/mail-remove.png', array('alt' => 'Eliminar mensaje')) ?></a></td>
        <td class="eh_foro_asunto"><?php echo link_to($registro->getMensaje()->getAsunto(), '@eh_foro_privados_mostrar?privado_id='.$registro->getId()) ?></td>
        <td class="eh_foro_remitente"><?php echo link_to_if(!$registro->getMensaje()->isByInvitado(), $registro->getMensaje()->getNick(), '@eh_foro_perfil?username='.$registro->getDestinatario()->getUsername()) ?></td>
        <td class="eh_foro_fecha"><?php echo format_datetime($registro->getMensaje()->getCreatedAt('U'), 'f') ?></td>
      </tr>
      <?php endforeach ?>
      <?php endif ?>
    </tbody>
  </table>
  
  <span class="eh_foro_bottom"><span></span></span>
</div>

<div class="eh_foro_opciones">
  <?php include_partial('ehForoMensajePrivado/paginas', array('pager' => $pager, 'uri' => '@eh_foro_privados_recibidos')) ?>
</div>