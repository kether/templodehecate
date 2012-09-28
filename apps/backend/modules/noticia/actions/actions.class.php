<?php

require_once dirname(__FILE__).'/../lib/noticiaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/noticiaGeneratorHelper.class.php';

/**
 * noticia actions.
 *
 * @package    templodehecate
 * @subpackage noticia
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class noticiaActions extends autoNoticiaActions
{
  public function executeExaminar(sfWebRequest $request)
  {
    $contenido = $this->getRoute()->getObject();
    
    $this->redirect($contenido->getNoticia()->getUrlForApp('frontend'));
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm(null, array('user' => $this->getUser(), 'seccion_id' => $request->getParameter('seccion_id')));
        
    $this->eh_foro_hilo = $this->form->getObject();
  }
}
