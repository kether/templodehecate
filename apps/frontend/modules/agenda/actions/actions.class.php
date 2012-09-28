<?php

/**
 * agenda actions.
 *
 * @package    templodehecate
 * @subpackage agenda
 * @author     Pablo Floriano
 */
class agendaActions extends sfActions
{
  /**
   * Muestra el contenido según el parámetro ID.
   *
   * @param sfRequest $request A request object
   */
  public function executeEvento(sfWebRequest $request)
  {
    $this->forward404Unless($evento = Doctrine::getTable('tdhEvento')->retrieveAutorizadoById($request->getParameter('id')));
    
    // Incrementamos el número de lecturas
    $evento->getHilo()->incrementaNumLecturas();
    
    $this->otros        = $evento->getRelacionados();
    $this->noticia      = isset($evento->getHilo()->Noticia) ? $evento->getHilo()->getNoticia() : new tdhNoticia();
    $this->evento       = $evento;
  }
  
  public function executeLista(sfWebRequest $request)
  {
    $this->lista = Doctrine::getTable('tdhEvento')->getPagerAutorizadas($request->getParameter('pagina'), array('orden' => 'ultimos'));
  }
  
  public function executeNuevoEvento(sfWebRequest $request)
  {
    $form = new tdhClienteEventoForm();
    
    if($request->isMethod('post'))
    {
      if($form->bindAndSave($request->getParameter('evento'), $request->getFiles('evento')))
      {
        $this->getUser()->setFlash('exito', 'Se guardó el evento.');
      }
    }
    
    if(!$request->isXmlHttpRequest())
    {
      $this->redirect('@tdh_evento_lista');
    }
    
    $this->form = $form;
  }
  
  /**
   * Se genera un mes con el calendario de actividades para ese intervalo de fechas.
   * 
   * @param sfWebRequest $request
   */
  public function executeCalendario(sfWebRequest $request)
  {
  	$fecha = $request->hasParameter('year') && $request->hasParameter('month') ? 
  	  new DateTime(sprintf('%d-%d', $request->getParameter('year'), $request->getParameter('month'))) :
  	  new DateTime();
  	
    $this->calendario = new ehCalendar($fecha);
    $this->calendario->setName('Agenda de '.sfConfig::get('app_nombre'));
    
    $fechaBegin  = new DateTime(date('Y-m-d', date('U', strtotime($fecha->format('Y-m-01'))) - 86400 * (date('N', strtotime($fecha->format('Y-m-01'))) - 1)));
    $fechaEnd    = new DateTime(date('Y-m-d', date('U', strtotime($fecha->format('Y-m-t'))) + 86400 * (7 - date('N', strtotime($fecha->format('Y-m-t'))))));
    
    $eventos = $request->getParameter('sf_format') == 'vcs' ? 
      Doctrine::getTable('tdhEvento')->getProximos() : // Sí es para un vCal
      Doctrine::getTable('tdhEvento')->getEntreDosFechas($fechaBegin->format('Y-m-d'), $fechaEnd->format('Y-m-d'));  // Si es para HTML
      
    $nbStyle = 1;
    
    foreach($eventos as $evento)
    {
      $eventoCal = new ehCalendarEvent($evento->getTitular(), new DateTime($evento->getFechaInicio().' 12:00:00'), new DateTime($evento->getFechaFin().' 12:00:00'));
      $eventoCal
        ->setUrl($this->generateUrl('tdh_evento', array('id' => $evento->getId(), 'slug' => $evento->getMensaje()->getSlug()), true))
        ->setAttribute(new ehCalendarAttribute('location', $evento->getDireccionCompleta()))
        ->setAttribute(new ehCalendarAttribute('description', strip_tags($evento->getMensaje()->getCuerpoHtml())))
        ->setNbStyle($nbStyle++);
      
      $this->calendario->addEvent($eventoCal);
    }
    
    // Si es una consulta AJAX sólo mostramos el parcial
    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('agenda/mes', array('calendario' => $this->calendario));
    }
  }
  
  public function executeApuntados(sfWebRequest $request)
  {
    if($request->hasParameter('apuntarme'))
    {
      try
      {        
        $evento = Doctrine::getTable('tdhEvento')->retrieveAutorizadoById($request->getParameter('evento_id'));
        Doctrine::getTable('tdhEventoApuntado')->desapuntar($request->getParameter('evento_id'), $this->getUser()->getUserId());
        
        if($request->getParameter('apuntarme') == true)
        {
          $apuntarme = new tdhEventoApuntado();
          $apuntarme
            ->setUsuarioId($this->getUser()->getUserId())
            ->setEventoId($request->getParameter('evento_id'))
            ->save();
        }
      }
      catch(Doctrine_Exception $e)
      {
        throw new sfException('El evento no parece existir en la base de datos.');
      }
    }
    
    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('agenda/apuntados', array('evento' => $evento));
    }
    else
    {
      throw new sfException('No es una petición XMLHttpRequest');
    }
  }
}
