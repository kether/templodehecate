<?php

class BaseehForoMensajePrivadoActions extends sfActions
{
  public function executeEscribir(sfWebRequest $request)
  {
    $this->forward404Unless($perfil = Doctrine::getTable('ehForoPerfil')->retrievePorUsername($request->getParameter('username')));

    // Creamos el formulario
    $msgForm = new ehForoClientePrivadoForm();
    
    $msgForm->setDefault('usuario_destino_id', $perfil->getUsuarioId());  // Marcamos el usuario destino
    $msgForm->setUserId($this->getUser()->getUserId()); // Cargamos el perfil del usuario origen
    
    if($request->hasParameter('asunto'))
    {
      // ATENCIÓN: Esto de momento no funciona y no sé porqué.
      $msgForm->getEmbeddedMensaje()->getWidget('asunto')->setDefault('RE: '.$request->getParameter('asunto')); // Si es la respuesta a un mensaje, ponemos el asunto por defecto
    }
    
    if($request->isMethod('post'))
    {
      if($msgForm->bindAndSave($request->getParameter('eh_foro_mensaje_privado')))
      {
        $this->redirect('@eh_foro_privados_enviados');
      }
    }
    
    $this->perfil   = $perfil;
    $this->msgForm  = $msgForm;
  }
  
  public function executeListaEnviados(sfWebRequest $request)
  {
    $this->pager = $this->getUser()->getPagerPrivadosEnviados($request->getParameter('pagina', 1));
  }
  
  public function executeListaRecibidos(sfWebRequest $request)
  {
    $this->pager = $this->getUser()->getPagerPrivadosRecibidos($request->getParameter('pagina', 1)); 
  }
  
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($privado = Doctrine::getTable('ehForoMensajePrivado')->retrievePorId($request->getParameter('privado_id')));
    $this->forward404Unless(
      $privado->getUsuarioDestinoId()         == $this->getUser()->getUserId() ||
      $privado->getUsuarioProcedenciaId()     == $this->getUser()->getUserId()
    );
    
    // Marcamos como leído el mensaje si lo lee el destinatario
    if($this->getUser()->getUserId() == $privado->getUsuarioDestinoId())
    {
      $privado->setEstadoLeido(true);
      $privado->save();
    }
    
    $this->mensaje = $privado->getMensaje();
    $this->privado = $privado;
  }
  
  public function executeBorrar(sfWebRequest $request)
  {
    $this->forward404Unless($privado = Doctrine::getTable('ehForoMensajePrivado')->retrievePorId($request->getParameter('privado_id')));
    
    if($privado->getUsuarioDestinoId() == $this->getUser()->getUserId())
    {
      $privado->setEstadoBorradoDestino(true)->save();
      return $request->isXmlHttpRequest() ? sfView::NONE : $this->redirect('@eh_foro_privados_recibidos');
    }
    elseif($privado->getUsuarioProcedenciaId() == $this->getUser()->getUserId())
    {
      $privado->setEstadoBorradoProcedencia(true)->save();
      return $request->isXmlHttpRequest() ? sfView::NONE : $this->redirect('@eh_foro_privados_enviados');
    }
    else
    {
      return $this->forward404();
    }
  }
}