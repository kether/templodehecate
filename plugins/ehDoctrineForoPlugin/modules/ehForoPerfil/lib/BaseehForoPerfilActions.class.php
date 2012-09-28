<?php

class BaseehForoPerfilActions extends sfActions
{
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($this->perfil = Doctrine::getTable('ehForoPerfil')->retrievePorUsername($request->getParameter('username')));
  }
  
  /**
   * Convierte o desconvierte a un amigo en otro
   * 
   * @param sfWebRequest $request
   */
  public function executeAmigar(sfWebRequest $request)
  {
    if($amistad = Doctrine::getTable('ehForoAmigo')->encontrarAmistad($this->getUser()->getUserId(), $request->getParameter('usuario_id')))
    {
      $amistad->delete();
      $on = false;
    }
    else
    {
      try
      {
        $amistad = new ehForoAmigo();
        $amistad->setInvitanteId($this->getUser()->getUserId())->setInvitadoId($request->getParameter('usuario_id'))->save();
        $on = true;
      }
      catch(Exception $e)
      {
        // Ocurrió un error
        $on = false;
      }
    }
    
    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('ehForoPerfil/amigar', array('on' => $on, 'usuario_id' => $request->getParameter('usuario_id')));
    }
    else
    {
      return $this->redirect('@eh_foro_perfil?username='.$this->getUser()->getUserName());
    }
  }
  
  /**
   * Ver la lista de amigos de un usuario.
   * 
   * @param sfWebRequest $request
   */
  public function executeAmigos(sfWebRequest $request)
  {
    if($request->getParameter('username'))
    {
      $this->forward404Unless($this->perfil = Doctrine::getTable('ehForoPerfil')->retrievePorUsername($request->getParameter('username')));
    }
    
    $this->amigos = Doctrine::getTable('ehForoPerfil')->retrievePagerUsers($request->getParameter('pagina', 1), array('user' => $this->getUser(), 'username' => $request->getParameter('username')));
  }
  
  public function executeEditar(sfWebRequest $request)
  {    
    $perfilForm = sfConfig::get('app_eh_foro_plugin_form_cliente_perfil', 'ehForoClientePerfilForm');
    
    $form = new $perfilForm(Doctrine::getTable('ehForoPerfil')->findOneByUsuarioId($this->getUser()->getUserId()), array('culture' => $this->getUser()->getCulture()));
    
    if($request->isMethod('post'))
    {
      if($form->bindAndSave($request->getParameter('eh_foro_perfil')))
      {
        // Modificamos el nick del las cookies de sesión si es necesario y si no está vacío
        if($form->getObject()->getNick())
        {
          $this->getUser()->setNick($form->getObject()->getNick());
        }
        
        // Ajustamos la nueva zona horaria
        $this->getUser()->setUserAttribute('timezone', $form->getObject()->getZonaHoraria());
        
        // Ajustamos el idioma
        $this->getUser()->setCulture($form->getObject()->getIdioma());
        
        $this->getUser()->setFlash('success', 'Se actualizó el perfil con los nuevos datos');
        
        $this->redirect('@eh_foro_perfil?username='.$this->getUser()->getUserName());
      }
    }
    
    $this->form = $form;
  }
  
  public function executeCambiarAvatar(sfWebRequest $request)
  {
    $form = new ehForoAvatarForm();
    $form->setUser($this->getUser());
    
    if($request->isMethod('post'))
    {
      if($form->bindAndGrabar($request->getParameter('eh_foro_avatar'), $request->getFiles('eh_foro_avatar')))
      {
        $response = $this->getResponse();
        $response->addCacheControlHttpHeader('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $response->setHttpHeader('Pragma', 'no-cache');
        $response->setHttpHeader('Expires', '0');
        $response->sendHttpHeaders();
      }
    }
    
    $this->form = $form;
  }
  
  public function executeCrearCuenta(sfWebRequest $request)
  {
    $this->redirectIf($this->getUser()->isAuthenticated(), '@eh_foro_perfil?username='.$this->getUser()->getUserName());
    
    $form = new ehForoClienteCrearCuentaForm();
    
    if($request->isMethod('post'))
    {
      if(ehForoConfig::haveReCaptcha())
      {
        $captcha = array(
          'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
          'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
        );
        
        $parameters = array_merge($request->getParameter('eh_register'), array('recaptcha' => $captcha));
      }
      else
      {
        $parameters = $request->getParameter('eh_register');
      }
      
      if($form->bindAndSave($parameters))
      {
        $this->getUser()->logIn($form->getObject()->getUsername(), false);
        $this->redirect('@eh_foro_perfil?username='.$form->getObject()->getUsername());
      }
    }
    
    $this->form = $form;
  }
  
  public function executeCambiarClave(sfWebRequest $request)
  {
    $form = new ehForoCambiarClaveForm($this->getUser()->getAuthUser());
    
    if($request->isMethod('post'))
    {
      if($form->bindAndSave($request->getParameter('eh_change_password')))
      {
        $this->getUser()->setFlash('success', 'Se modificó la contraseña correctamente.');
        $this->redirect('@eh_foro_perfil?username='.$this->getUser()->getUserName());
      }
    }
    
    $this->form = $form;
  }
  
  /**
   * Envía un correo electrónico con una contraseña regenerada al usuario o e-mail especificado.
   * 
   * @param sfWebRequest $request
   */
  public function executeRegenerarClave(sfWebRequest $request)
  {
    $this->redirectIf($this->getUser()->isAuthenticated(), '@eh_foro_perfil?username='.$this->getUser()->getUserName());
    
    $form = new ehForoClienteRegenerarForm();
    
    if($request->isMethod('post'))
    {
      $form->bind($request->getParameter('eh_regenerate'));
      
      if($form->isValid())
      {        
        if($perfil = Doctrine::getTable('ehForoPerfil')->retrievePorUsernameOrEmail($form->getValue('username'), $form->getValue('username')))
        {          
          if($perfil->getUsuario()->getIsActive())
          {
            $password = $this->getUser()->generateRandomPassword();
            $perfil->getUsuario()->setPassword($password);
            $perfil->getUsuario()->save();
            
            $para     = array($perfil->getEmail() => $perfil->getUsuario()->getUsername());
            $desde    = array(sfConfig::get('app_mailer_desde_email', 'noresponder@estudiohecate.com') => sfConfig::get('app_mailer_desde_nombre', 'EstudioHecate.com'));
            $asunto   = 'Petición para regenerar su contraseña en '.sfConfig::get('app_nombre');
            $cuerpo   = "Saludos ".$perfil->getUsuario()->getUsername().",\n\nNos ha enviado una petición desde el sitio web ".sfConfig::get('app_nombre')." para regenerar tu contraseña, que queda tal y como aparece a continuación:\n\nUsuario: ".$perfil->getUsuario()->getUsername()."\nContraseña: ".$password."\n\nEsperamos que le sea de ayuda,\nEquipo de ".sfConfig::get('app_nombre');
            
            $mensaje = $this->getMailer()->compose($desde, $para, $asunto, $cuerpo);
            $this->getMailer()->send($mensaje);
                        
            $this->getUser()->setFlash('success', 'Se ha envíado un e-mail con los datos del usuario y la contraseña; comprueba su buzón por favor.', false);
          }
          else
          {
            $this->getUser()->setFlash('error', 'El usuario están inhabilitados y no se puede regenerar la contraseña. Póngase en contacto con nosotros si tiene alguna duda o cree una nueva cuenta.', false);
          }
        }
        else
        {
          $this->getUser()->setFlash('error', 'El usuario o el e-mail no existen en nuestra base de datos.', false);
        }
      }
    }
    
    $this->form = $form;
  }
}