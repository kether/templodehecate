<?php

require_once dirname(__FILE__).'/../lib/recursoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/recursoGeneratorHelper.class.php';

/**
 * recurso actions.
 *
 * @package    templodehecate
 * @subpackage recurso
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class recursoActions extends autoRecursoActions
{
  public function executeExaminar(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
  
    $this->redirect($this->getContext()->getConfiguration()->generaUrlFromApp('frontend', 'tdh_recurso', array(
      'slug' => $object->getPrimerMensaje()->getSlug(), 
      'id' => $object->getRecurso()->getId()
    )));
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
        ->setSeccionId($this->getRoute()->getObject()->getRecurso()->getSeccionId())
        ->save();
  
      $this->getUser()->setFlash('notice', 'Se añadió la relación de noticia.');
    }
  
    $this->redirect('@tdh_recurso_edit?id='.$this->getRoute()->getObject()->getId());
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm(null, array('user' => $this->getUser(), 'seccion_id' => $request->getParameter('seccion_id')));
  
    $this->eh_foro_hilo = $this->form->getObject();
  }
}
