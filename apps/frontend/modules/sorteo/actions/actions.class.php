<?php

/**
 * sorteo actions.
 *
 * @package    templodehecate
 * @subpackage sorteo
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sorteoActions extends sfActions
{
  public function executeLista(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('tdhSorteo')->retrievePagerVisibles($request->getParameter('pagina')); 
  }
  
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeDescripcion(sfWebRequest $request)
  {
    $this->forward404Unless($this->sorteo = Doctrine::getTable('tdhSorteo')->retrieveOneBySlug($request->getParameter('slug')));
    
    $this->condiciones = $this->sorteo->getCondiciones();
    
    $this->setLayout('layoutTotal');
  }
  
  /**
   * 
   * @param sfWebRequest $request
   */
  public function executeTwitter(sfWebRequest $request)
  {
    $this->forward404Unless($this->sorteo = Doctrine::getTable('tdhSorteo')->retrieveOneBySlug($request->getParameter('slug')));
    
    $twitter = new ehUtilesTwitter(array('context' => $this->getContext()));
    
    if($request->getParameter('auth') == '1')
    {
      if($data = $twitter->doAuthenticate(array('reasignar_oauth' => true)))
      {        
        $this->form = new tdhSorteoRedSocialForm(null, array('sorteo' => $this->sorteo, 'data' => $data, 'servicio' => 'twitter'));
        $this->setTemplate('mensaje');
        $this->setLayout('layoutTotal');
      }
      else
      {
        $this->redirect('@tdh_sorteo?slug='.$request->getParameter('slug'));
      }
    }
    else
    {
      $this->redirect($twitter->getAuthLink($this->generateUrl('tdh_sorteo_twitter', array('slug' => $this->sorteo->getSlug(), 'auth' => 1), true)), 302);
    }
  }
  
  public function executeFacebook(sfWebRequest $request)
  {
    $this->forward404Unless($this->sorteo = Doctrine::getTable('tdhSorteo')->retrieveOneBySlug($request->getParameter('slug')));
    
    $facebook = new ehUtilesFacebook(array('context' => $this->getContext()));
    
    if($request->getParameter('auth') == '1')
    {
      if($data = $facebook->doAuthenticate(array('reasignar_oauth' => true)))
      {
        $this->form = new tdhSorteoRedSocialForm(null, array('sorteo' => $this->sorteo, 'data' => $data, 'servicio' => 'facebook'));

        $this->setTemplate('mensaje');
        $this->setLayout('layoutTotal');
      }
      else
      {
        $this->redirect('@tdh_sorteo?slug='.$request->getParameter('slug'));
      }
    }
    else
    {
      $this->redirect($facebook->getAuthLink($this->generateUrl('tdh_sorteo_facebook', array('slug' => $this->sorteo->getSlug(), 'auth' => 1), true)), 302);
    }
  }
  
  public function executeMensaje(sfWebRequest $request)
  {
    $this->forward404Unless($this->sorteo = Doctrine::getTable('tdhSorteo')->retrieveOneBySlug($request->getParameter('slug')));
    $this->form = new tdhSorteoRedSocialForm(null, array('sorteo' => $this->sorteo));
    
    if($request->isMethod('post'))
    {      
      $this->form->bind($request->getParameter('mensaje_sorteo'));
      
      if(!$this->form->isLikeIt())
      {
        $noLike = " (Asegurate de que has dado en las páginas 'Me gusta' en tu Facebook.)";
      }
      
      if($this->form->isValid())
      {
        if($this->form->procesar($this->getUser()->getIp()))
        {
          $this->getUser()->setFlash('success', sprintf('¡Gracias por participar en el sorteo de %s! ¡Te avisaremos por e-mail si lo ganas!'.(isset($noLike) ? $noLike : ''), $this->sorteo->getNombre()));
        }
        else
        {
          $this->getUser()->setFlash('error', 'No se te pudo registrar en el sorteo, quizá ya estés inscrito.');
        }
      
        $this->redirect('@tdh_sorteo?slug='.$request->getParameter('slug'));
      }
    }
    else
    {
      $this->redirect('@tdh_sorteo?slug='.$request->getParameter('slug'));
    }
  }
}
