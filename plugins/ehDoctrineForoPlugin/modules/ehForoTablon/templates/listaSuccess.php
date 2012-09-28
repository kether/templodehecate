<?php use_helper('Date') ?>

<?php $sf_response->setTitle(ehForoConfig::getStatic('nombre')) // title ?>

<div id="eh_foro_lista_tablones" class="eh_foro_tabla eh_foro_round">
  <span class="eh_foro_top"><span></span></span>
  
  <table>
    <?php foreach($secciones as $seccion): ?>
    <thead>
      <tr>
        <th class="eh_foro_seccion" colspan="2"><?php echo $seccion->getNombre() ?></th>
        <th class="eh_foro_temas">Temas</th>
        <th class="eh_foro_respuestas">Respuestas</th>
        <th class="eh_foro_ultimo_mensaje">Último mensaje</th>
      </tr>
    </thead>
    <?php foreach($seccion->getTablonesEnOrden($sf_user) as $key => $tablon): ?>
    <tbody>
      <tr class="<?php echo $key % 2 == 0 ? 'par' : 'impar' ?>">
        <td class="eh_foro_leido">
          <?php echo link_to(image_tag($tablon->getUriIcon() ? $tablon->getUriIcon() : (ehForoConfig::getStatic('theme_path').'/images/'.($tablon->esLeido() ? 'forum-read.png' : 'forum-no-read.png')), array('alt' => 'Nuevos temas')), '@eh_foro_tablon?pagina=1&id='.$tablon->getId(), array('title' => $tablon->getNombre())) ?>
        </td>
        <td class="eh_foro_tablon">
          <h3><?php echo link_to($tablon->getNombre(), '@eh_foro_tablon?pagina=1&id='.$tablon->getId()) ?></h3>
          <div class="eh_foro_descripcion"><?php echo $tablon->getDescripcion() ?></div>
          <?php if($tablon->getNumSubtablones()): ?><div class="eh_foro_subtablones"><strong>Subtablones:</strong> <?php foreach($tablon->getMisSubforos() as $key => $subforo): ?><?php echo ($key == 0 ? '' : ', ').link_to($subforo->getNombre(), '@eh_foro_tablon?pagina=1&id='.$subforo->getId(), array('class' => 'eh_foro_subtablon')) ?><?php endforeach ?></div><?php endif ?>
        </td>
        <td class="eh_foro_temas"><?php echo $tablon->getNumHilos() ?></td>
        <td class="eh_foro_respuestas"><?php echo $tablon->getNumMensajes() ?></td>
        <td class="eh_foro_ultimo_mensaje">
          <?php if(!is_null($tablon->getUltimoMensajeByUltimoHilo())): ?>
          Hace <?php echo time_ago_in_words($tablon->getUltimoMensajeByUltimoHilo()->getFechaPublicacion('U')) ?><br />
          En: <?php echo link_to($tablon->getPrimerMensajeByUltimoHilo()->getAsunto(), '@eh_foro_tema?pagina='.$tablon->getUltimoHilo()->getUltimaPagina().'&id='.$tablon->getPrimerMensajeByUltimoHilo()->getHiloId().'#msg'.$tablon->getUltimoMensajeByUltimoHilo()->getId()) ?><br />
          Por: <?php if(!is_null($tablon->getUltimoMensajeByUltimoHilo()->getUsuarioId())): ?><?php echo link_to($tablon->getUltimoMensajeByUltimoHilo()->getNick(), '@eh_foro_perfil?username='.$tablon->getUltimoMensajeByUltimoHilo()->getUsuario()) ?><?php else: ?><?php echo $tablon->getUltimoMensajeByUltimoHilo()->getNick() ?><?php endif ?>
          <?php else: ?>
          Ningún mensaje
          <?php endif ?>
        </td>
      </tr>
    </tbody>
    <?php endforeach ?>
    <?php endforeach ?>
  </table>
  
  <span class="eh_foro_bottom"><span></span></span>
</div>

<div id="eh_foro_conectados">
  <h2>¿Quién está conectado?</h2>
  En total hay <b><?php echo $conectados->getNumConectados() ?></b> usuarios(s) en los últimos <b><?php echo $conectados->getMinutosTimeout() ?></b> minutos de los cuales
  <b><?php echo $conectados->getNumRegistrados() ?></b> son registrado(s) y <b><?php echo (string) $conectados->getNumInvitados() ?></b> invitado(s)
  <?php if($conectados->getNumRegistrados()>0): ?>
  <div class="eh_foro_registrados">
    <ul>
      <li>Registrados:</li>
      <?php foreach($conectados->getUsuariosRegistrados() as $conectado): ?>
      <li id="<?php echo 'usuario_'.$conectado->getUsuario()->getUsername()?>"><?php echo link_to($conectado->getNick(), '@eh_foro_perfil?username='.$conectado->getUsuario()->getUsername()) ?></li>
      <?php endforeach ?>
    </ul>
  </div>
  <?php endif ?>
</div>