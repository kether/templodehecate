$(document).ready(
  function()
  {
    $("#buscar_palabras_clave").autocomplete('<?php echo url_for('@tdh_buscar') ?>', {
      minChars: 3,
      maxItemsToShow: 10
    });
  }
);