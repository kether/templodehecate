<ul>
<?php foreach($resultados as $resultado): ?>
  <li><?php echo link_to($resultado->getPrimerMensaje()->getAsunto(), $resultado->getRouting()); ?></li>
<?php endforeach; ?>
</ul>