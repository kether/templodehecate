<?php

require_once dirname(__FILE__).'/../lib/eventoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/eventoGeneratorHelper.class.php';

/**
 * evento actions.
 *
 * @package    templodehecate
 * @subpackage evento
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventoActions extends autoEventoActions
{
  public function executeExaminar(sfWebRequest $request)
  {
    $contenido = $this->getRoute()->getObject();
  
    $this->redirect($contenido->getEvento()->getUrlForApp('frontend'));
  }
}
