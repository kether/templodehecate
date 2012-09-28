<?php

/**
 * contacto actions.
 *
 * @package    templodehecate
 * @subpackage contacto
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactoActions extends sfActions
{
  
  /**
   * Permite enviar nuevas consultas a los administradores del sitio web
   * 
   * @param sfWebRequest $request
   */
  public function executeFormulario(sfWebRequest $request)
  {
    $this->form = new tdhConsultaForm(null, array('context' => $this->getContext()));
    
    if($request->isMethod('post'))
    {
      $captcha = array(
        'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
        'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
      );
      
      $parameters = array_merge($request->getParameter('consulta'), array('recaptcha' => $captcha));
      
      if($this->form->bindAndSave($parameters))
      {
        $this->getUser()->setFlash('success', 'La consulta fue enviada a los responsables.');
        $this->redirect('@tdh_contacto_consulta?codigo='.$this->form->getObject()->getCodigo());
      }
    }
  }
  
  /**
   * Muestra el hilo de una consulta
   * 
   * @param sfWebRequest $request
   */
  public function executeConsulta(sfWebRequest $request)
  {
    $this->forward404Unless($this->consulta = Doctrine::getTable('tdhConsulta')->findOneBy('codigo', $request->getParameter('codigo')));
    
    $this->respuestaForm = new tdhConsultaRespuestaForm(null, array('user' => $this->getUser()));
    
    $this->respuestaForm->setDefault('consulta_id', $this->consulta->getId());
  }
  
  /**
   * Guarda una respuesta
   * 
   * @param sfWebRequest $request
   */
  public function executeGuardarRespuesta(sfWebRequest $request)
  {
    $respuestaForm = new tdhConsultaRespuestaForm(null, array('context' => $this->getContext()));
    
    if($respuestaForm->bindAndSave($request->getParameter('respuesta')))
    {
      $this->getUser()->setFlash('success', 'Se grabó la respuesta.');
    }
    
    if($request->isXmlHttpRequest())
    {
      $consulta = Doctrine::getTable('tdhConsulta')->findOneBy('codigo', $request->getParameter('codigo'));
      $this->renderPartial('formularioRespuesta', array('consulta' => $consulta, 'respuestaForm' => $respuestaForm));
    }
    else
    {
      $this->redirect('@tdh_contacto_consulta?codigo='.$request->getParameter('codigo'));
    }
  }
  
  /**
   * Elimina una consulta entera (y todas sus respuestas)
   * 
   * @param sfWebRequest $request
   */
  public function executeEliminarConsulta(sfWebRequest $request)
  {
    $this->forward404Unless($consulta = Doctrine::getTable('tdhConsulta')->findOneBy('codigo', $request->getParameter('codigo')));
    
    if(!$consulta->getTipo()->esUsuarioAutorizado($this->getUser()))
    {
      throw new Exception('El usuario no tiene privilegios para borrar la consulta.');
    }
    
    $consulta->delete();
    $this->redirect('@tdh_contacto');
  }
  
  /**
   * Elimina una respuesta dada en un hilo de consulta
   * 
   * @param sfWebRequest $request
   */
  public function executeEliminarRespuesta(sfWebRequest $request)
  {
    if(!$this->getUser()->isAdministrador())
    {
      throw new Exception('El usuario no tiene privilegios para borrar la consulta.');
    }
  }
  
  /**
   * Cierra un hilo de consulta abierto en la web.
   * 
   * @param sfWebRequest $request
   */
  public function executeResolver(sfWebRequest $request)
  {
    $this->forward404Unless($consulta = Doctrine::getTable('tdhConsulta')->findOneBy('codigo', $request->getParameter('codigo')));
    
    if(!$consulta->getTipo()->esUsuarioAutorizado($this->getUser()))
    {
      throw new Exception('El usuario no está autorizado a resolver ésta consulta.');
    }
    
    $consulta
      ->setResolver(true)
      ->save();
    
    if($request->isXmlHttpRequest())
    {
      // Lo que sea
    }
    else
    {
      $this->redirect('@tdh_contacto_consulta?codigo='.$request->getParameter('codigo'));
    }
  }
}
