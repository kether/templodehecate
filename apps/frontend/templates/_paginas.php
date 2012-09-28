<?php if ($pager->haveToPaginate()): ?>  
<div class="tdh_paginar_contenido">
  <?php $uri = $sf_request->hasParameter('seccion_slug') ? $uri.'?seccion_slug='.$sf_request->getParameter('seccion_slug').'&' : $uri.'?' ?>
  
  <ul>
  <?php if($pager->getPage() > $pager->getPreviousPage()): ?>
    <li><?php echo link_to('&laquo; Página anterior', $uri.'&pagina='.$pager->getPreviousPage()) ?></li>
  <?php endif ?>
  
  <?php if(($pager->getPage() - $pager->getParameter('links', 5)) > 0): ?>
    <li><?php echo link_to('...', $uri.'&pagina='.$pager->getFirstPage()) ?></li>
  <?php endif ?>
    
  <?php $links = $pager->getLinks($pager->getParameter('links', 5)); foreach ($links as $pagina): ?>
    <?php echo ($pagina == $pager->getPage()) ? '<li class="tdh_pagina_actual">'.$pagina.'</li>' : '<li>'.link_to($pagina, $uri.'&pagina='.$pagina).'</li>' ?>
  <?php endforeach ?>
  
  <?php if($pager->getLastPage() > $pager->getCurrentMaxLink()): ?>
    <li><?php echo link_to('...', $uri.'&pagina='.$pager->getLastPage()) ?></li>
  <?php endif ?>
  
  <?php if($pager->getPage() < $pager->getNextPage()): ?>
    <li><?php echo link_to('Página siguiente &raquo;', $uri.'&pagina='.$pager->getNextPage()) ?></li>
  <?php endif ?>
  </ul>
</div>  
<?php endif ?>