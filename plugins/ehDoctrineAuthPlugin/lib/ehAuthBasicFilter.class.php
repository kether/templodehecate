<?php

/*
 * Proyecto ehAuthPlugin
 * (c) 2008 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * 
 * 
 * 
 * @package       ehAuthPlugin
 * @subpackage    filter
 * @author        Pablo Floriano <p.floriano@estudiohecate.com>
 * @version       ehAuthBasicSecurityFilter.class.php 06/03/2008 21:32:38
 */

class ehAuthBasicFilter extends sfFilter
{
  const COOKIE_NAME         = 'ehRemember';
  
  public function execute ($filterChain)
  {
    if($this->isFirstCall())
    {
      if(!$this->getContext()->getUser()->isAuthenticated())
      {
        if ($cookie = $this->getContext()->getRequest()->getCookie(sfConfig::get('app_eh_auth_plugin_remember_cookie_name', self::COOKIE_NAME)))
        {
          $rk = Doctrine_Query::create()
            ->from('ehAuthUser u')
            ->where('u.remember_key = ?', $cookie)
            ->addWhere('u.is_active = ? ', true)->fetchOne();
      
          if ($rk)
          {
            $this->getContext()->getUser()->logIn($rk);
          }
          else
          {
            $this->getContext()->getUser()->logOut();
          }
        }
      }
      
      if($this->getContext()->getUser()->getUserAttribute('timezone'))
      {
        date_default_timezone_set($this->getContext()->getUser()->getUserAttribute('timezone'));
      }
    }
    
    $filterChain->execute();
  }
}