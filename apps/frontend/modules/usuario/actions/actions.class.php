<?php

require_once(sfConfig::get('sf_plugins_dir').'/ehDoctrineAuthPlugin/modules/ehAuthLogin/lib/BaseehAuthLoginActions.class.php');

/**
 * usuario actions.
 *
 * @package    templodehecate
 * @subpackage usuario
 * @author     Pablo Floriano
 */
class usuarioActions extends BaseehAuthLoginActions
{  
  /**
   * Muestra el "muro" de perfil de un usuario.
   * 
   * @param sfWebRequest $request
   */
  public function executePerfil(sfWebRequest $request)
  {
    $this->forward404Unless($this->usuario = Doctrine::getTable('ehAuthUser')->retrieveOneJoinPerfilByUsername($request->getParameter('username')));
    
    $this->perfil = $this->usuario->getPerfil();
    $this->favoritos = $this->usuario->getSeccionesFavoritas();
    $this->recursos = $this->usuario->getMisRecursosFavoritos();
    $this->actividad = $this->usuario->getMiActividad();
    $this->amigos = $this->usuario->getMisAmigos();
    
    if($this->getUser()->isAuthenticated() && $this->getUser()->getUserId() != $this->usuario->getId())
    {
      if(Doctrine::getTable('ehForoAmigo')->encontrarAmistad($this->getUser()->getUserId(), $this->usuario->getId()))
      {
        $this->amistad = true;
      }
      else
      {
        $this->amistad = false;
      }
    }
    else
    {
      $this->amistad = null;
    }
  }
  
  public function executeVincularServicio(sfWebRequest $request)
  {
    $this->forward404Unless($usuario = Doctrine::getTable('ehAuthUser')->retrieveOneJoinPerfilByUsername($request->getParameter('username')));
    
    if($this->getUser()->getUserId() != $usuario && !$this->getUser()->isAdministrador())
    {
      throw new Exception('No está autorizado a realizar esta operación de des/vinculación de servicio.');
    }
    
    // Desvinculamos si el estado es '0'.
    if($request->getParameter('estado') == 0)
    {
      if($oauth = Doctrine::getTable('tdhOauth')->findOneByUsuarioIdAndServicio($usuario->getId(), $request->getParameter('servicio')))
      {
        $oauth->delete();
        
        switch($request->getParameter('servicio'))
        {
          case 'twitter':
            $usuario->getPerfil()->setPerfilTwitter('')->save();
            break;
          case 'facebook':
            $usuario->getPerfil()->setPerfilFacebook('')->save();
            break;
          case 'google':
            // ...
            break;
        }
      }
    }
    // Vinculamos cuenta con servicio
    else
    {
      //FIXME Tenemos que permitir vinculaciones
    }
    
    if($request->isXmlHttpRequest())
    {
      return sfView::NONE;
    }
    else
    {
      return $this->redirect('@eh_foro_perfil?username='.$usuario->getUsername());
    }
  }
  
  /**
   * Muestra una página de advertencia de sitio no encontrado.
   * 
   * @param sfWebRequest $request
   */
  public function executeSeguro(sfWebRequest $request)
  {
    $this->setLayout('layoutError');
  }
  
  public function executeSigninTwitter(sfWebRequest $request)
  {
    $twitter = new ehUtilesTwitter(array('context' => $this->getContext()));
    
    if($request->getParameter('auth') == '1')
    {
      if($data = $twitter->doAuthenticate())
      {
        if($usuario = Doctrine::getTable('ehAuthUser')->retrieveOneByUidAndService($data['user_id'], 'twitter'))
        {
          $this->getUser()->logIn($usuario, true);
          $this->getUser()->getAuthUser()->getPerfil()->setPerfilTwitter($data['screen_name'])->save();
          $this->redirect('@eh_foro_perfil?username='.$usuario->getUsername());
        }
        else
        {
          $class = sfConfig::get('app_eh_auth_plugin_signin_form', 'ehAuthSigninForm');
          $this->form = new $class(null, array('servicio' => 'twitter', 'uid' => $data['user_id'], 'token' => $data['oauth_token'], 'token_secret' => $data['oauth_token_secret']));
          $this->setTemplate('signin');
        }
      }
      else
      {
        $this->getUser()->setFlash('error', 'Ocurrió un error al intentar autentificarse mediante Twitter.');
        $this->redirect('@eh_auth_signin');
      }
    }
    else
    {
      $this->redirect($twitter->getAuthLink($this->generateUrl('tdh_auth_twitter', array('auth' => 1), true)), 302);
    }
  }
  
  public function executeSigninFacebook(sfWebRequest $request)
  {
    $facebook = new ehUtilesFacebook(array('context' => $this->getContext()));
    
    if($request->getParameter('auth') == '1')
    {
      if($data = $facebook->doAuthenticate())
      {
        if($usuario = Doctrine::getTable('ehAuthUser')->retrieveOneByUidAndService($data['info']['id'], 'facebook'))
        {
          $this->getUser()->logIn($usuario, true);
          $this->getUser()->getAuthUser()->getPerfil()->setPerfilFacebook($data['info']['link'])->save();
          
          $this->redirect('@eh_foro_perfil?username='.$usuario->getUsername());
        }
        else
        {
          $class = sfConfig::get('app_eh_auth_plugin_signin_form', 'ehAuthSigninForm');
          $this->form = new $class(null, array('servicio' => 'facebook', 'uid' => $data['info']['id'], 'token' => $data['token']));
          $this->setTemplate('signin');
        }
      }
      else
      {
        $this->getUser()->setFlash('error', 'Ocurrió un error al intentar autentificarse mediante Facebook.');
        $this->redirect('@eh_auth_signin');
      }
    }
    else
    {
      $this->redirect($facebook->getAuthLink($this->generateUrl('tdh_auth_facebook', array('auth' => 1), true)), 302);
    }
  }
}
