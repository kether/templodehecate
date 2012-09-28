<?php

require_once dirname(__FILE__).'/../lib/socialGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/socialGeneratorHelper.class.php';

/**
 * social actions.
 *
 * @package    templodehecate
 * @subpackage social
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class socialActions extends autoSocialActions
{
  public function executeEnviarAhora(sfWebRequest $request)
  {
    $social = $this->getRoute()->getObject();
  
    if($social->enviarInmediatamente() == true)
    {
      $this->getUser()->setFlash('notice', 'Se envió el evento social pendiente.');
    }
    else
    {
      $this->getUser()->setFlash('notice', 'Ocurrió un error al realizar el envío social pendiente.');
    }
    
    $this->redirect('@tdh_envio_social_pendiente');
  }
}
