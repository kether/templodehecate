<?php

class BaseehForoTablonActions extends sfActions
{
  public function executeLista(sfWebRequest $request)
  {
    $this->secciones  = Doctrine::getTable('ehForoSeccion')->getEnOrden();
        
    $this->conectados = new ehForoConectados();
  }
}