<div id="tdh_contenidos_no_autorizados">
  <h2>Contenidos por revisar</h2>
  <ul>
    <li><?php echo link_to_if($des_noticias > 0, $des_noticias.' noticias', '@tdh_noticia')  ?></li>
    <li><?php echo link_to_if($des_criticas > 0, $des_criticas.' críticas/reseñas', '@tdh_critica')  ?></li>
    <li><?php echo link_to_if($des_recursos > 0, $des_recursos.' recursos', '@tdh_recurso')  ?></li>
    <li><?php echo link_to_if($des_eventos > 0, $des_eventos.' eventos/actividades', '@tdh_critica')  ?></li>
  </ul>
</div>