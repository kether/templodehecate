<?php if($sf_user->isAuthenticated()): ?>
	
	<?php if($sf_request->isXmlHttpRequest()): ?>
	<script type="text/javascript">$(function(){ tdhFavoritoTooltip(); });</script>
  <?php endif ?>
	
	<div id="<?php echo 'tdh_favorita_seccion_'.$seccion_id ?>" class="tdh_favorito">
	  <a 
	   onclick="tdhAddFavorito('<?php echo url_for(sprintf('@tdh_seccion_favorita?seccion_id=%s&opcion=%s', $seccion_id, $es_favorito ? '0' : '1')) ?>', '<?php echo '#tdh_favorita_seccion_'.$seccion_id ?>'); return false;" 
	   href="<?php echo url_for(sprintf('@tdh_seccion_favorita?seccion_id=%s&opcion=%s', $seccion_id, $es_favorito ? '0' : '1')) ?>" 
	   class="<?php echo $es_favorito ? 'tdh_si_favorito' : 'tdh_no_favorito' ?>"
	   title="<?php echo $es_favorito ? 'Quitar de mis favoritos' : 'Añadir a mis favoritos' ?>">
	    <span>Favorito</span>
	  </a>
	</div>
<?php endif ?>