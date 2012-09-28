<?php

class BaseehForoTemaActions extends sfActions
{
  public function executeLista(sfWebRequest $request)
  {    
    $this->forward404Unless($tablon = Doctrine::getTable('ehForoTablon')->retrieveAutorizadoPorId($request->getParameter('id'), $this->getUser())); 
    
    // Asignamos las variables a la plantilla
    $this->tablon = $tablon;
    $this->temas  = $tablon->getPagerHilos(
      $request->getParameter('pagina', 1), 
      array('usuario_id' => $this->getUser()->isAuthenticated() ? $this->getUser()->getUserId() : null), 
      true);
    
    $this->subtablones = $tablon->getMisSubforos($this->getUser());
  }
  
  public function executeMostrar(sfWebRequest $request)
  {
    if($this->getUser()->isAuthenticated())
    {
      $this->forward404Unless($tema = Doctrine::getTable('ehForoHilo')->retrieveAutorizadoPorId($request->getParameter('id'), $this->getUser()->getUserId()));
      $tema->leidoPorUsuarioId($this->getUser()->getUserId()); 
    }
    else
    {
      $this->forward404Unless($tema = Doctrine::getTable('ehForoHilo')->retrieveAutorizadoPorId($request->getParameter('id')));
    }
    
    $tema->incrementaNumLecturas();
    
    $this->tema     = $tema;
    $this->mensajes = $tema->getPagerMensajes($request->getParameter('pagina', 1), array('invitante_id' => $this->getUser()->getUserId()));
    
    // Variables útiles para el filtro
    $this->getUser()->setTemplateVar('tema', $this->tema);
  }
  
  public function executeLeerTablon(sfWebRequest $request)
  {
    if($tablon = Doctrine::getTable('ehForoTablon')->retrieveAutorizadoPorId($request->getParameter('id'), $this->getUser()))
    {
      $tablon->leidoPorUsuarioId($this->getUser()->getUserId());
      $this->redirect('@eh_foro_tablon?pagina=1&id='.$tablon->getId());
    }
    else
    {
      throw sfException('No hay coincidencia con el ID del tablón indicado.');
    }
  }
}