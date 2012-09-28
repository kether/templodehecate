<?php

class BaseehForoMensajeActions extends sfActions
{
  /**
   * Muestra un mensaje en función del parámetro ID de la cabecera
   * 
   * @param sfWebRequest $request
   */
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($mensaje = Doctrine::getTable('ehForoMensaje')->retrieveAutorizadoPorId($request->getParameter('id'), $this->getUser()->getUserId()));
    
    $this->mensaje  = $mensaje;    
    $this->tema     = $mensaje->getHilo();
  }
  
  public function executeEliminar(sfWebRequest $request)
  {
    $this->forward404Unless($mensaje = Doctrine::getTable('ehForoMensaje')->retrieveAutorizadoPorId($request->getParameter('mensaje_id'), $this->getUser()->getUserId()));
    $this->forward404Unless($mensaje->estaUsuarioAutorizado($this->getUser(), ehForoMensaje::NIVEL_ACCESO_MODERADOR));
    
    $mensaje->delete();
    
    if($request->isXmlHttpRequest())
    {
      return sfView::NONE;
    }
    else
    {
      if(!$mensaje->getHilo()->isDeleted())
      {
        $this->redirect('@eh_foro_tema?pagina='.$request->getParameter('pagina', 1).'&id='.$mensaje->getHilo()->getId());
      }
      else
      {
        $this->redirect('@eh_foro_tablon?pagina=1&id='.$mensaje->getHilo()->getTablonId());
      }
    }
  }
  
  public function executeEditar(sfWebRequest $request)
  {
    // Comprobamos que el usuario tiene acceso a editar el mensaje    
    $this->forward404Unless($mensaje = Doctrine::getTable('ehForoMensaje')->retrieveAutorizadoPorId($request->getParameter('mensaje_id'), $this->getUser()->getUserId()));
    $this->forward404Unless($mensaje->estaUsuarioAutorizado($this->getUser(), ehForoMensaje::NIVEL_ACCESO_PROPIETARIO));
    
    $msgForm = new ehForoClienteMensajeForm($mensaje); 
    
    // Quitamos el campo del 'asunto' si es una respuesta
    if($mensaje->getHilo()->getPrimerMensajeId() != $mensaje->getId())
    {
      unset($msgForm['asunto']);
    }
    
    // Permitimos el uso de markdown o no
    if(!ehForoConfig::getStatic('permiso_markdown_usuarios') && !$this->getUser()->isAdministrador())
    {
      unset($msgForm['markdown']);
    }
    
    if($request->isMethod('post'))
    {
      if($msgForm->bindAndSave($request->getParameter('eh_foro_mensaje')))
      {
        $this->redirectToLoadFileOrUri(
           '@eh_foro_tema?pagina='.$request->getParameter('pagina', 1).'&id='.$mensaje->getHiloId(),
          $msgForm->getValue('cargar_ficheros'),
          $msgForm->getObject()->getId()
        );
      }
    }
    
    $this->msgForm  = $msgForm;
    $this->tema     = $mensaje->getHilo();
  }
  
  public function executeNuevoTema(sfWebRequest $request)
  {
    // Nos aseguramos de que existe el tablón
    $this->forward404Unless($tablon = Doctrine::getTable('ehForoTablon')->retrieveAutorizadoPorId($request->getParameter('tablon_id')));
    
    // Comprobamos si el usuario está autorizado a crear nuevos temas
    $this->forwardIf(
      !$this->getUser()->isAuthenticated() && !ehForoConfig::getStatic('permiso_new_thread_invitados'), 
      sfConfig::get('sf_secure_module'), 
      sfConfig::get('sf_secure_action'));
    
    // Creamos el formulario
    $msgForm = new ehForoClienteTemaForm(null, array('user' => $this->getUser()));
    $msgForm->setDefault('tablon_id', $tablon->getId());
    
    // Válidamos el formulario
    if($request->isMethod('post'))
    {
      if($msgForm->bindAndSave($request->getParameter('eh_foro_hilo')))
      {
        $this->redirectToLoadFileOrUri(
          '@eh_foro_tema?pagina=1&id='.$msgForm->getObject()->getId(),
          $msgForm->getEmeddedMensaje()->getValue('cargar_ficheros'), 
          $msgForm->getEmeddedMensaje()->getObject()->getId());
      }
    }
    
    $this->msgForm  = $msgForm;
    $this->tablon   = $tablon;
  }
  
  public function executeResponderTema(sfWebRequest $request)
  {
    $this->forward404Unless($tema = Doctrine::getTable('ehForoHilo')->retrieveAutorizadoPorId($request->getParameter('hilo_id')));
    
    $this->forwardIf(
      !$this->getUser()->isAuthenticated() && !ehForoConfig::getStatic('permiso_post_invitados'), 
      sfConfig::get('sf_secure_module'), 
      sfConfig::get('sf_secure_action'));
    
    $msgForm = new ehForoClienteMensajeForm(null, array('user' => $this->getUser()));
    
    unset($msgForm['asunto']); // Quitamos el INPUT del asunto
    
    $msgForm->setDefault('hilo_id', $tema->getId());
    
    if($request->isMethod('post'))
    {      
      if($msgForm->bindAndSave($request->getParameter('eh_foro_mensaje')))
      {
        $this->redirectToLoadFileOrUri(
          '@eh_foro_tema?pagina='.$tema->getUltimaPagina().'&id='.$tema->getId().'#msg'.$msgForm->getObject()->getId(),
          $msgForm->getValue('cargar_ficheros'),
          $msgForm->getObject()->getId()
        );
      }
    }
    
    // Si es AJAX cargamos solo el parcial
    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('editarMensaje', array(
      	'msgForm' => $msgForm, 
      	'hiddenFields' => $msgForm->renderHiddenFields(),
      	'id' => 'eh_foro_editar_respuesta',
      	'action' => $this->generateUrl('eh_foro_mensaje_responder', array('hilo_id' => $tema->getId())),
      	'legend' => sprintf('Responder en «%s»', $tema->getAsunto())
      ));
    }
    // Si es una petición normal cargamos el parcial y el layout
    else
    {
      $this->msgForm  = $msgForm;
      $this->tema     = $tema;
    }
  }
  
  /**
   * Esta acción procesa los ficheros adjuntos a un mensaje.
   * 
   * @param sfWebRequest $request
   */
  public function executeCargarFicheros(sfWebRequest $request)
  {
    $this->forwardIf(
      !ehForoConfig::permisoCargarFicheros(), 
      sfConfig::get('sf_secure_module'), 
      sfConfig::get('sf_secure_action'));
    
    $this->forward404Unless($mensaje = Doctrine::getTable('ehForoMensaje')->retrieveAutorizadoPorId($request->getParameter('mensaje_id'), $this->getUser()->getUserId()));  
        
    $msgForm = new ehForoClienteAdjuntoForm();
    $msgForm->setDefault('mensaje_id', $mensaje->getId());
    
    if($request->isMethod('post'))
    {      
      if($msgForm->bindAndSave($request->getParameter('eh_foro_adjunto'), $request->getFiles('eh_foro_adjunto')))
      {        
        $this->redirectToLoadFileOrUri(
          '@eh_foro_mensaje?id='.$mensaje->getId(),
          $msgForm->getValue('cargar_ficheros'),
          $mensaje->getId()
        );
      }
    }
    
    $this->msgForm = $msgForm;
    $this->mensaje = $mensaje;
  }
  
  public function executeDescargarFichero(sfWebRequest $request)
  {
    $this->forward404Unless($adjunto = Doctrine::getTable('ehForoAdjunto')->findOneById($request->getParameter('adjunto_id')));
        
    session_cache_limiter('none');
    
    $this->setLayout(false);
    
    $response = $this->getResponse();
    
    $response->clearHttpHeaders();
    $response->setHttpHeader('Content-Description', 'Transferencia de fichero');
    $response->setContentType('application/octet-stream');
    $response->setHttpHeader('Content-Disposition', 'attachment; filename='.$adjunto->getNombreFichero());
    $response->setHttpHeader('Content-Transfer-Encoding', 'binary');
    $response->setHttpHeader('Expires', '0');
    $response->addCacheControlHttpHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0');
    $response->setHttpHeader('Pragma', 'public');
    $response->setHttpHeader('Content-Length', filesize($adjunto->getFichero()));
    
    // Aumentamos el contador de descargas del fichero
    $adjunto->addDescarga();
    
    $this->getUser()->shutdown();
    $response->sendHttpHeaders();
    $response->setContent(readfile($adjunto->getFichero()));
    $response->sendContent();
    
    return sfView::NONE;
  }
    
  /**
   * Redirige a la página de carga de ficheros si se cumple la condición.
   * 
   * @param string $uri
   * @param string $condicion
   * @param integer $mensajeId
   */
  protected function redirectToLoadFileOrUri($uri, $condicion, $mensajeId)
  {
    $this->redirect($condicion ? '@eh_foro_cargar_ficheros?mensaje_id='.$mensajeId : $uri);
  }
}