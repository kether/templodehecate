<?php use_stylesheet('tdh8_listados.css', 'last') ?>

<?php $sf_response->setTitle('Lista de juegos • '.tdhConfig::get('nombre')) ?>

<?php slot('navegacion') ?>
<?php if(isset($favoritos) && $favoritos->count() > 0) include_partial('indice/favoritos', array('favoritos' => $favoritos)) ?>
<?php end_slot() ?>

<div id="tdh_seccion_lista">
  
  <h1><?php echo $sf_request->hasParameter('letra') ? 'Lista de juegos' : 'Los juegos más populares' ?></h1>
  
  <div class="tdh_abecedario">
    <?php 
      $nAbc = strlen($abc);
      for($i = 0; $i < $nAbc; $i++) {
        echo link_to($abc[$i], '@tdh_seccion_lista?letra='.urlencode($abc[$i]).'&tipo='.$sf_request->getParameter('tipo').($sf_request->hasParameter('genero') ? '&genero='.$sf_request->getParameter('genero') : '')).'&nbsp;'; 
      }
    ?>
    | <?php echo link_to('Todos', '@tdh_seccion_lista') ?>
  </div>
  
  <div class="tdh_lista">
    <script type="text/javascript">$(function(){ tdhFavoritoTooltip(); });</script>
    <ul>
      <?php if($pager->getNbResults() < 1): ?>
      <li><h2>Ningún juego aquí.</h2></li>
      <?php else: ?>      
      <?php foreach($pager->getResults() as $seccion): ?>
      <li id="<?php echo 'tdh_seccion_'.$seccion->getId() ?>">
        <div class="tdh_imagen">
          <?php echo link_to(image_tag($seccion->getImagen('thumb'), array('alt' => $seccion->getNombre())), $seccion->getUrl() ? $seccion->getUrl() : '@tdh_seccion?seccion_slug='.$seccion->getSlug()) ?>
        </div>
        <div class="tdh_datos">
	        <?php include_partial('seccion/favorito', array('seccion_id' => $seccion->getId(), 'es_favorito' => $seccion->getEsMiFavorito($sf_user->getUserId()))) ?>
          
          <h2><?php echo link_to($seccion->getNombre(), $seccion->getUrl() ? $seccion->getUrl() : '@tdh_seccion?seccion_slug='.$seccion->getSlug()) ?></h2>
	        <div class="tdh_informacion">Género: <?php echo link_to($seccion->getGenero(), '@tdh_seccion_lista?genero='.$seccion->getGenero()->getSlug()) ?></div>
	        <div class="tdh_descripcion">
	          <?php echo $seccion->getDescripcion(); ?>
	        </div>
	        <div class="tdh_informacion">Tipo: <?php echo link_to($seccion->getTipo(), '@tdh_seccion_lista?tipo='.$seccion->getTipo()->getSlug()) ?></div>
        </div>
        
        <div class="tdh_fix"></div>
      </li>
      <?php endforeach ?>
      <?php endif ?>
    </ul>
  </div>
  
  <div class="tdh_paginacion"><?php include_partial('paginas', array('pager' => $pager, 'uri' => sprintf('@tdh_seccion_lista?letra=%s&tipo=%s&genero=%s', $sf_request->getParameter('letra'), $sf_request->getParameter('tipo'), $sf_request->getParameter('genero')))) ?></div>
</div>