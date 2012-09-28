<div class="eh_foro_paginas">
<?php echo $pager->getNbResults() ?> mensajes
<?php if ($pager->haveToPaginate()): ?>
  •
  <?php if($pager->getPage() > $pager->getPreviousPage()): ?>
    <?php echo link_to('&laquo; Anterior', $uri.'?pagina='.$pager->getPreviousPage()).' | ' ?>
  <?php endif ?>
  
  <?php if(($pager->getPage() - $pager->getParameter('links')) > 0): ?>
    <?php echo link_to('...', $uri.'?pagina='.$pager->getFirstPage()) ?>
  <?php endif ?>
  
  <?php $links = $pager->getLinks($pager->getParameter('links')); foreach ($links as $pagina): ?>
    <?php echo ($pagina == $pager->getPage()) ? $pagina : link_to($pagina, $uri.'?pagina='.$pagina) ?>    
  <?php endforeach ?>
  
  <?php if($pager->getLastPage() > $pager->getCurrentMaxLink()): ?>
    <?php echo link_to('...', $uri.'?pagina='.$pager->getLastPage()) ?>
  <?php endif ?>
  
  <?php if($pager->getPage() < $pager->getNextPage()): ?>
    <?php echo ' | '.link_to('Siguiente &raquo;', $uri.'?pagina='.$pager->getNextPage()) ?>
  <?php endif ?>
  
<?php endif ?>
</div>