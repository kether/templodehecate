<?php use_helper('Date') ?>
<?php use_stylesheet('tdh8_asociaciones', 'last') ?>

<?php slot('navegacion') ?>
<h1>Oferta de jugadores</h1>
<ul>
  <?php foreach($usuarios as $key => $usuario): ?>
  <li>[<?php echo format_date($usuario->getPeticionGrupo()->getCreatedAt(), 'dd/MM/yyyy') ?>] El jugador <?php echo link_to($usuario->getNick(), '@eh_foro_perfil?username='.$usuario->getUsername()) ?> busca un grupo de juego en <?php echo $usuario->getPeticionGrupo()->getLocalidad() ?></li>
  <?php endforeach ?>
</ul>
<?php end_slot() ?>

<div id="tdh_lista_asociaciones" class="tdh_asociaciones">
  <h1><?php echo tdh_set_title('Clubes, asociaciones y grupos') ?></h1>
  
  <ul>
    <?php foreach($asociaciones as $key => $asociacion): ?>
    <li>
      <div class="tdh_icono"><?php echo link_to(image_tag($asociacion->getImagePath('mic', true), array('alt' => $asociacion->getNombre())), '@tdh_asociacion?slug='.$asociacion->getSlug(), array('title' => $asociacion->getNombre())) ?></div>
      <div class="tdh_informacion">
        <h2><?php echo link_to($asociacion->getNombre(), '@tdh_asociacion?slug='.$asociacion->getSlug()) ?></h2>
        <div class="tdh_situacion">
          <?php echo $asociacion->getLocalidad() ?> (<?php echo sfCultureInfo::getInstance($sf_user->getCulture())->getCountry($asociacion->getPais()) ?>)
          <?php echo $asociacion->getWeb() ? link_to($asociacion->getWeb(), $asociacion->getWeb()) : '' ?>
        </div>
        <div class="tdh_detalles" id="<?php echo 'tdh_inscripcion_'.$asociacion->getId() ?>">
          <?php include_partial('botonUnirse', array('asociacion' => $asociacion)) ?>
        </div>
      </div>
      <div class="tdh_fix"></div>
    </li>
    <?php endforeach ?>
  </ul>
  
  <div class="tdh_opciones"><?php echo link_to('Nuevo club/asociación', '@tdh_asociacion_nueva') ?></div>
</div>