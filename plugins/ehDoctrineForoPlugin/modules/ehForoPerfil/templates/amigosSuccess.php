<?php use_javascript(ehForoConfig::getStatic('theme_path').'/js/jquery.ehforoplugin.js') ?>

<?php $sf_response->setTitle('Lista de perfiles • '.ehForoConfig::getStatic('nombre')) ?>

<?php slot('eh_foro_navegador') ?>
<?php include_partial('ehForoTablon/navegador', array(
  'nav' => !isset($perfil) ? 
    array(array('Lista de perfiles')) : 
    array(
      array('Lista de perfiles', '@eh_foro_amigos'), 
      array('Perfil de '.$perfil->getNickArreglado(), '@eh_foro_perfil?username='.$perfil->getUsuario()->getUsername()),
      array('Lista de personas siguiendo')
    )
  )); ?>
<?php end_slot() ?>

<div id="eh_foro_lista_amigos" class="eh_foro_tabla eh_foro_round">
  <span class="eh_foro_top"><span></span></span>
  <table>
    <tbody>
      <?php if($amigos->count() > 0): ?>
      <?php foreach($amigos as $amigo): ?>
      <tr>
        <td class="eh_foro_amigar_lista_amigos">
          <?php if($sf_user->isAuthenticated() && $amigo->getId() != $sf_user->getUserId()): ?>
          <div id="<?php echo 'eh_foro_perfil_amigar_'.$amigo->getId() ?>" class="eh_foro_amigar">
            <?php include_partial('ehForoPerfil/amigar', array('usuario_id' => $amigo->getId(), 'on' => ($amigo->Invitantes && $amigo->getInvitantes()->getFirst()))) ?>
          </div>
          <?php endif ?>
        </td>
        <td class="eh_foro_avatar"><?php echo link_to(image_tag($amigo->getPerfil()->getAvatarMiniPath(), array('alt' => $amigo->getPerfil()->getNickArreglado())), '@eh_foro_perfil?username='.$amigo->getUsername()) ?></td>
        <td class="eh_foro_pseudonimo">
          <div><?php echo link_to($amigo->getPerfil()->getNickArreglado(), '@eh_foro_perfil?username='.$amigo->getUsername()) ?></div>
          <div class="eh_foro_nombreusuario"><?php echo $amigo->getUsername() ?></div>
        </td>
      </tr>
      <?php endforeach ?>
      <?php else: ?>
      <tr>
        <td colspan="3">¡Ups! No hay ningún perfil que mostrar.</td>
      </tr>
      <?php endif ?>
    </tbody>
  </table>
  <span class="eh_foro_bottom"><span></span></span>
</div>

<div class="eh_foro_opciones">
  <div class="eh_foro_paginas">
    <?php include_partial('ehForoTema/paginas', array('pager' => $amigos, 'uri' => '@eh_foro_amigos?')) ?>
  </div>
</div>