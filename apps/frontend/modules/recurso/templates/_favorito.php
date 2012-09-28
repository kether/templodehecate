<?php if($sf_request->isXmlHttpRequest()): ?>
<script type="text/javascript">
$(function(){
  $(".tdh_favorito a[title]").qtip({
    style: { classes: 'ui-tooltip-blue ui-tooltip-tipsy' },
    position: { my: 'top center', at: 'bottom center' }
  });
});
</script>
<?php endif ?>

<div class="tdh_favorito">
  <a 
   onclick="tdhAddFavorito('<?php echo url_for(sprintf('@tdh_recurso_favorito?recurso_id=%s&opcion=%s', $recurso_id, $es_favorito ? '0' : '1')) ?>', '<?php echo '#tdh_favorito_recurso_'.$recurso_id ?>'); return false;" 
   href="<?php echo url_for(sprintf('@tdh_recurso_favorito?recurso_id=%s&opcion=%s', $recurso_id, $es_favorito ? '0' : '1')) ?>" 
   class="<?php echo $es_favorito ? 'tdh_si_favorito' : 'tdh_no_favorito' ?>"
   title="<?php echo $es_favorito ? 'Quitar de mis favoritos' : 'Añadir a mis favoritos' ?>">
    <span>Favorito</span>
  </a>
</div>