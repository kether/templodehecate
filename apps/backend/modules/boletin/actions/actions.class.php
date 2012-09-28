<?php

/**
 * boletin actions.
 *
 * @package    templodehecate
 * @subpackage boletin
 * @author     Pablo Floriano <kether@templodehecate.com>
 */
class boletinActions extends sfActions
{
  public function executeFormulario(sfWebRequest $request)
  {
    $formulario = new tdhBoletinForm(null, array('action' => $this));
    
    if($request->isMethod('post'))
    {
      $formulario->bindAndSend($request->getParameter('boletin'));
      $this->getUser()->setFlash('exito', 'Se pusieron en cola los correos electrónicos');
    }
    
    $this->spool      = Doctrine::getTable('tdhMailMensaje')->count(); // Doctrine::getTable('tdhMailMensaje')->findAll()->count();
    $this->formulario = $formulario;
  }
  
  /**
   * Enviamos la cola de mensajes almacenados en la base de datos y volvemos al formulario del boletín.
   * 
   * @param sfWebRequest $request
   */
  public function executeEnviar(sfWebRequest $request)
  {
    $numEmails = $this->getMailer()->flushQueue();
    $this->getUser()->setFlash('exito', "Se envío una cola de $numEmails mensajes");
        
    $this->redirect('@tdh_boletin');
  }
  
  /**
   * Vaciamos la cola de mensajes y volvemos al formulario del boletín.
   * 
   * @param sfWebRequest $request
   */
  public function executeVaciar(sfWebRequest $request)
  {
    Doctrine::getTable('tdhMailMensaje')->deleteAll();
    $this->getUser()->setFlash('exito', 'Se vacío toda la cola de mensajes');
    $this->redirect('@tdh_boletin');
  }
}
