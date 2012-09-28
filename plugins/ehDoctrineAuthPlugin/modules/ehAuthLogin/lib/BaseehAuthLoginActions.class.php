<?php

class BaseehAuthLoginActions extends sfActions
{
  /**
   * Esta acción autentifica al usuario.
   * 
   * @param sfWebRequest $request
   */
  public function executeSignin(sfWebRequest $request)
  {
    $user = $this->getUser();
    $this->redirectIf($user->isAuthenticated(), '@homepage');
    
    $class = sfConfig::get('app_eh_auth_plugin_signin_form', 'ehAuthSigninForm');
    $this->form = new $class();
    
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('eh_auth_login'));
      
      if($this->form->isValid())
      {
        $this->getUser()->logIn($this->form->getValue('user'), $this->form->getValue('remember'));
        $this->redirect('@homepage');
      }
    }
    else
    {
      $statusCode401 = sfConfig::get('app_eh_auth_plugin_set_status_401', true);
    	
    	// AJAX
      if ($request->isXmlHttpRequest())
      {
        $this->getResponse()->setHeaderOnly(true);
        
        if($statusCode401)
        {
          $this->getResponse()->setStatusCode(401);
        }

        return sfView::NONE;
      }
      
      $module = sfConfig::get('sf_login_module');
      if ($this->getModuleName() != $module)
      {
        return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
      }
      
      if($statusCode401)
      {
        $this->getResponse()->setStatusCode(401);
      }
    }
  }
  
  /**
   * Esta acción termina la sesión del usuario.
   * 
   * @param sfWebRequest $request
   */
  public function executeSignout(sfWebRequest $request)
  {
    $this->getUser()->logOut();
    
    $signoutUrl = sfConfig::get('app_eh_auth_plugin_success_signout_url', $request->getReferer());

    $this->redirect('' != $signoutUrl ? $signoutUrl : '@homepage');
  }
}