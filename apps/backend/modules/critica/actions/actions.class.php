<?php

require_once dirname(__FILE__).'/../lib/criticaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/criticaGeneratorHelper.class.php';

/**
 * critica actions.
 *
 * @package    templodehecate
 * @subpackage critica
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class criticaActions extends autoCriticaActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm(null, array('seccion_id' => $request->getParameter('seccion_id')));
    $this->eh_foro_hilo = $this->form->getObject();
  }
  
  public function executeExaminar(sfWebRequest $request)
  {
    $contenido = $this->getRoute()->getObject();
    
    $this->redirect($contenido->getCritica()->getUrlForApp('frontend'));
  }
  
  public function executeCaptura(sfWebRequest $request)
  {
    $this->redirect('@tdh_critica_captura_new?critica_id='.$this->getRoute()->getObject()->getCritica()->getId());
  }
  
  public function executeVideo(sfWebRequest $request)
  {
    $this->redirect('@tdh_critica_video_new?critica_id='.$this->getRoute()->getObject()->getCritica()->getId());
  }
  
  public function executeNoticia(sfWebRequest $request)
  {
    if($noticia = Doctrine::getTable('tdhNoticia')->findOneByHiloId($this->getRoute()->getObject()->getId()))
    {
      $noticia->delete();
      $this->getUser()->setFlash('notice', 'Se ha eliminado la relación de noticia.');
    }
    else
    {
      $noticia = new tdhNoticia();
      $noticia
        ->setHiloId($this->getRoute()->getObject()->getId())
        ->setSeccionId($this->getRoute()->getObject()->getCritica()->getSeccionId())
        ->save();
      
      $this->getUser()->setFlash('notice', 'Se añadió la relación de noticia.');
    }
    
    $this->redirect('@tdh_critica_edit?id='.$this->getRoute()->getObject()->getId());
  }
}
