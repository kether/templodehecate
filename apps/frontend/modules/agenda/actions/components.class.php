<?php

class agendaComponents extends sfComponents
{
  public function executeEventos(sfWebRequest $request)
  {
    $this->eventos    = Doctrine::getTable('tdhEvento')->getAutorizados(4, array('solo_proximos' => true));
  }
}