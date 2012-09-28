<ul>
  <?php foreach($consulta->getRespuestas() as $respuesta): ?>
  <li>
    <h3>Respuesta de <?php if($respuesta->isInvitado()): ?>Desconocido<?php else: ?><?php echo $respuesta->getUsuario()->getPerfil()->getNickArreglado() ?><?php endif ?> enviado el <?php echo format_datetime($respuesta->getCreatedAt(), 'F') ?></h3>
    <div class="tdh_respuesta">
      <?php echo nl2br($respuesta->getDescripcion()) ?>
    </div>
  </li>
  <?php endforeach ?>
</ul>
