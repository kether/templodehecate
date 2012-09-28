<?php

class BaseehUtilesTwitterActions extends sfActions
{
	const NS_TWITTER = 'twitter';
  
  public function executeCallback(sfWebRequest $request)
	{
	}
	
	public function executeConectar(sfWebRequest $request)
	{
	  if($request->getParameter('conectar') == 1)
	  {  
		  $twitter = new TwitterOAuth(
		    sfConfig::get('app_eh_utiles_plugin_tw_consumer_key'), 
		    sfConfig::get('app_eh_utiles_plugin_tw_consumer_secret')
		  );
		  
		  $requestToken = $twitter->getRequestToken($this->generateUrl('eh_utiles_twitter_callback', array(), true));
		  
		  switch($twitter->http_code)
		  {
		    case 200:
		      $this->getUser()->setAttribute('oauth_token', $requestToken['oauth_token'], self::NS_TWITTER);
		      $this->getUser()->setAttribute('oauth_token_secret', $requestToken['oauth_token_secret'], self::NS_TWITTER);
		      
		      $this->redirect($twitter->getAuthorizeURL($requestToken['oauth_token']));
		      break;
		    default:
		      throw Exception('Problema con Twitter');
		      break;
		  }
	  }
	}
}