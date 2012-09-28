<?php

abstract class tdhContenidoForm extends ehForoHiloForm
{
  /**
   * @var ehAuthUser
   */
  protected $usuario = null;
  
  /**
   * @var sfRequest
   */
  protected $request = null;
  
  /**
   * @var tdhSeccion
   */
  protected $seccion = null;
  
  /**
   * @var string
   */
  protected $methodResource = null;
    
  public function configure()
  {
    parent::configure();
    
    if($this->methodResource == null)
    {
      throw new Exception('Es necesario especificar el atributo "$methodResource" en '.get_class($this));
    }
    
    $this->usuario = $this->getOption('usuario') instanceOf ehAuthUser ? 
      $this->getOption('usuario') : 
      sfContext::getInstance()->getUser();
      
    $this->request = $this->getOption('request') instanceOf sfRequest ? 
      $this->getOption('request') : 
      sfContext::getInstance()->getRequest();
    
    $this->seccion = $this->getOption('seccion') instanceOf tdhSeccion ?
      ($this->getOption('seccion')) :
      ($this->request->hasParameter('seccion_slug') ? Doctrine::getTable('tdhSeccion')->findOneBySlug($this->request->getParameter('seccion_slug')) : null);
    
    $this->useFields(array(
      'estado_oculto',
      'estado_cerrado',
      'estado_pinchado',
      'estado_general',
      'estado_seccion'
    ));
    
    $this->embedRelation('PrimerMensaje', 'ehForoMensajeForm', array('user' => $this->usuario));
    
    $this->getWidgetSchema()->setLabel('PrimerMensaje', 'Mensaje');
  }
  
  public function haveNoticia()
  {
    if($this->methodResource == 'getNoticia' || $this->getOption('noticia') == true)
    {
      return true;
    }
    elseif($this->isNew())
    {
      return false;
    }
    else
    {
      return Doctrine::getTable('tdhNoticia')->findOneByHiloId($this->getObject()->getId()) ? true : false;
    }
  }
  
  public function configureSocialsFields()
  {
    if(tdhConfig::haveSocial())
    {
      $this->setWidget('twitter', new sfWidgetFormInputCheckbox(array('default' => $this->isNew())));
      $this->setWidget('facebook', new sfWidgetFormInputCheckbox(array('default' => $this->isNew())));
      
      $this->setValidator('twitter', new sfValidatorBoolean());
      $this->setValidator('facebook', new sfValidatorBoolean());
      
      $this->getWidgetSchema()->setHelp('twitter', 'Si marcas esta opción se lanzará automáticamente un \'tweet\' a @'.sfConfig::get('app_eh_utiles_plugin_tw_name_account'));
      $this->getWidgetSchema()->setHelp('facebook', 'Si marcas esta opción se lanzará automáticamente un link al muro de '.sfConfig::get('app_eh_utiles_plugin_fb_page_name'));
    }
  }
  
  /**
   * Enviamos al Facebook y Twitter los datos principales de nuestro nuevo contenido, usando acortadores de URL
   * en caso necesario.
   */
  public function sendSocials()
  {    
    // Si el contenido no está activo/visible/aprobado, ignora por completo el envío a las redes sociales.
    if(!$this->getObject()->getPrimerMensaje()->getEstadoActivo() || !tdhConfig::haveSocial()) return false;
    
    /**
     * @var tdhContenido
     */
    $methodResource = $this->methodResource;
    
    /**
     * @var string URL completo del frontend de la aplicación
     */
    $link = $this->getObject()->$methodResource()->getUrlForApp('frontend');
    
    $facebook = new tdhEnvioSocialPendiente();
    
    $facebook
      ->setNombre($this->getObject()->getPrimerMensaje()->getAsunto())
      ->setDescripcion('Enviado por '.$this->getObject()->getPrimerMensaje()->getNick(true))
      ->setMensaje($this->getObject()->$methodResource()->getEntradilla())
      ->setImagen('http://'.$this->request->getHost().$this->getObject()->$methodResource()->getImagePath('peq', true))
      ->setUrl($link)
      ->setProgramadoPara($this->getObject()->getPrimerMensaje()->getVisibleDesde());
    
    // Enviamos a Twitter un mensaje
    if($this->getValue('twitter') == true)
    {
      $twitter = clone $facebook;
      $twitter->setServicio('twitter')->save();
    }
    
    // Enviamos un mensaje al muro de Facebook de la aplicación
    if($this->getValue('facebook') == true)
    {
      $facebook->setServicio('facebook')->save();
    }
  }
  
  /**
   * Envia notificaicones a los colaboradores de una sección para que estén al tanto de los cambios realizados.
   * Importante: éste método debe colocarse detrás del doSave().
   * 
   * @param string $cuerpo Cuerpo formateado en markdown
   * @param string $asunto Asunto por defecto para la notificación, normalmente no es necesario.
   * @return integer Devuelve el número de notificaciones enviadas
   */
  public function sendNotifications($cuerpo, $asunto = '[Notificación]')
  {
    if($this->getObject()->getPrimerMensaje()->getEstadoActivo()) return 0;
    
    $colaboradores = strpos($this->methodResource, 'Evento') === false ? 
      Doctrine::getTable('ehAuthUser')->retrieveColaboradoresBySeccion($this->seccion->getId()) : 
      Doctrine::getTable('ehAuthUser')->findBy('is_super_admin', true);
    
    $i = 0;
    
    foreach($colaboradores as $colaborador)
    {
      $notificacion = new ehForoNotificacion();
      $notificacion->setCuerpo($cuerpo)->setDestinatario($colaborador->getId())->setAsunto($asunto)->enviar();
      $i++;
    }
    
    return $i;
  }
  
  public function doSave($con = null)
  {
    if($this->isNew())
    {
      if(!$this->getValue('tablon_id') && !$this->getObject()->getTablonId())
	    {
	      $contenido = $this->getValue(str_replace('get', '', $this->methodResource));
	      
	      if(!isset($contenido['seccion_id']))
	      {
	        $seccion_id = $this->getEmbeddedForm('Noticia')->getObject()->getSeccionId();
	      }
	      else
	      {
	        $seccion_id = $contenido['seccion_id'];
	      }
	      
	      $seccion   = Doctrine::getTable('tdhSeccion')->findOneById($seccion_id);
	      $this->getObject()->setTablonId($seccion->getTablonId());
	    }
	    
      $this->getObject()->setPrimerMensaje($this->getEmbeddedForm('PrimerMensaje')->getObject());
      
      // Lo ocultamos por defecto si no es un colaborador
      if(!$this->usuario->esColaborador(!is_null($this->seccion) ? $this->seccion->getSlug() : ''))
      {
        $this->getEmbeddedForm('PrimerMensaje')->getObject()->setEstadoActivo(false);
      }
      
	    parent::doSave($con);
	    
	    // Actualizamos el tablón
      $this
        ->getEmbeddedForm('PrimerMensaje')
        ->getObject()
        ->actualizarHiloTablon();
        
    }
    else
    {
      parent::doSave($con);
    }
  }
} 