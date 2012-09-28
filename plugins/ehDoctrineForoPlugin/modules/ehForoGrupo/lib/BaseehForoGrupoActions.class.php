<?php

class BaseehForoGrupoActions extends sfActions
{
  public function executeLista(sfWebRequest $request)
  {
  }
  
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($this->grupo = Doctrine::getTable('ehForoGrupo')->findOneBySlug($request->getParameter('slug')));
  }
}