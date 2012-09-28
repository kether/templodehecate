<?php

class ehForoNotificacion 
{
  /**
   * @var ehForoMensajePrivado
   */
  protected $mensajePrivado = null;
  
  public function __construct($mensajePrivado = null)
  {
    $this->mensajePrivado = $mensajePrivado instanceOf ehForoMensajePrivado ? $mensajePrivado : new ehForoMensajePrivado();
    
    // Si no hay enviante escogemos al administrador por defecto para ello
    if(!$this->mensajePrivado->getMensaje()->getUsuarioId())
    {
      $this->mensajePrivado->getMensaje()->setUsuario(Doctrine::getTable('ehAuthUser')->retrieveByUsername(ehForoConfig::getStatic('user_admin_default')));
    }
    
    // Si no hay asunto para la notificación ponemos "[Notificación]"
    if(!$this->mensajePrivado->getMensaje()->getAsunto())
    {
      $this->mensajePrivado->getMensaje()->setAsunto('[Notificación]');
    }
    
    if($this->mensajePrivado->isNew())
    {
      $this->mensajePrivado->setEstadoNotificacion(true)->getMensaje()
        ->setBbcode(false)
        ->setMarkdown(true)
        ->setFirma(false);
    }
  }
  
  /**
   * 
   * @param mixed $destinatario
   * @return ehForoNotificacion Instancia modificada del objeto
   * @throws Exception
   */
  public function setDestinatario($destinatario)
  {
    if(is_numeric($destinatario))
    {
      $this->mensajePrivado->setUsuarioDestinoId($destinatario);
    }
    else
    {
      if($user = Doctrine::getTable('ehAuthUser')->retrieveByUsername($destinatario))
      {
        $this->mensajePrivado->setUsuarioDestinoId($user->getId());
      }
      else
      {
        throw new Exception('El usuario destinatario no fue encontrado en la base de datos.');
      }
    }
    
    return $this;
  }
  
  /**
   * Setea el asunto de la notificación. Opcional.
   * 
   * @param string $asunto
   * @return ehForoNotificacion Instancia modificada del objeto
   */
  public function setAsunto($asunto)
  {
    $this->mensajePrivado->getMensaje()->setAsunto($asunto);
    return $this;
  }
  
  /**
   * Setea el cuerpo de la notificación. Obligatoria.
   *
   * @param string $cuerpo
   * @return ehForoNotificacion Instancia modificada del objeto
   */
  public function setCuerpo($cuerpo)
  {
    $this->mensajePrivado->getMensaje()->setCuerpo($cuerpo);
    return $this;
  }
  
  public function enviar()
  {
    $this->mensajePrivado->save();
    return $this;
  }
}