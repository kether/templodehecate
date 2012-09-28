<?php
foreach($resultados as $resultado):
  echo $resultado->getPrimerMensaje()->getAsunto()."\n";
endforeach;
?>