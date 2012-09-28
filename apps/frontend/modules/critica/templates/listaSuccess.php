<?php use_helper('Number', 'ehUtilesRutas') ?>
<?php use_stylesheet('tdh8_listados.css', 'last') ?>
<?php $sf_response->setTitle('Archivo de reseñas • '.tdhConfig::get('nombre')) ?>

<?php slot('menu_administrador', link_to_app('Añadir y modificar reseñas', 'backend', 'tdh_critica')) ?>

<div id="tdh_critica_lista" class="tdh_contenido_lista">
  <h1>Archivo de reseñas</h1>
  
  <ul>
    <?php foreach($lista->getResults() as $key => $critica): ?>
    <li class="<?php echo $key % 2 == 0 ? 'tdh_par' : 'tdh_impar' ?>" id="<?php echo 'tdh_critica_'.$critica->getId() ?>">
      <div class="tdh_captura">
        <?php echo link_to(image_tag($critica->getCoverPath('covpeq'), array('alt' => $critica->getTitular())), $critica->getRouting(), array('title' => $critica->getTitular())) ?>
      </div>
      <div class="tdh_detalles">
        <h2><?php echo link_to($critica->getTitular(), $critica->getRouting()) ?></h2>
        <div class="tdh_info"><span class="tdh_campo">Colección:</span> <span class="tdh_valor"><?php echo $critica->getSeccion() ?></span></div>
        <div class="tdh_info"><span class="tdh_campo">Género:</span> <span class="tdh_valor"><?php echo $critica->getSeccion()->getGenero() ?></span></div>
      </div>
      <div class="tdh_nota">
        <?php echo $critica->getEstadoSinNota() ? 'ND' : format_number(number_format($critica->getNota(), 1)) ?>
      </div>
      
      <div class="tdh_fix"></div>
    </li>
    <?php endforeach ?>
  </ul>
</div>

<div class="tdh_paginacion"><?php include_partial('global/paginas', array('pager' => $lista, 'uri' => '@tdh_critica_lista')) ?></div>