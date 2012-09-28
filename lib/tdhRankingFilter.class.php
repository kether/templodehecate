<?php

class tdhRankingFilter extends sfFilter
{
  public function execute($filterChain)
  {
    $request = $this->getContext()->getRequest();
    
    if($this->isFirstCall() && $request->hasParameter('seccion_slug'))
    {
      Doctrine::getTable('tdhPopular')->incrementarPopularidadPorSeccionSlug($request->getParameter('seccion_slug'));
    }
    
    $filterChain->execute();
  }
}