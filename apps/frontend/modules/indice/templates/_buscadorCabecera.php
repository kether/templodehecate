<form action="<?php echo url_for('@tdh_buscar') ?>" method="get">
  <fieldset>
    <input type="text" name="q" id="buscar_palabras_clave" value="<?php echo $sf_request->getParameter('q') ?>" />
    <input type="image" src="<?php echo image_path('btns/search.png') ?>" id="buscar_boton" />
  </fieldset>
</form>