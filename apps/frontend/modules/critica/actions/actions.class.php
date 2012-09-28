<?php

/**
 * critica actions.
 *
 * @package    templodehecate
 * @subpackage critica
 * @author     Pablo Floriano
 */
class criticaActions extends sfActions
{
  /**
   * Muestra el contenido según el parámetro ID.
   *
   * @param sfRequest $request A request object
   */
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($critica = Doctrine::getTable('tdhCritica')->retrieveAutorizadoById($request->getParameter('id')));
    
    // Redirigimos si la ruta no es la correcta
    $routing = $critica->getRouting(true);
    
    if($request->hasParameter('pag'))
    {
      $routing['parametros']['pag'] = $request->getParameter('pag', 1);
    }
    
    $this->redirectUnless($this->generateUrl($routing['ruta'], $routing['parametros'], true) == $request->getUri(), $critica->getRouting(), 301);
    
    // Incrementamos el número de lecturas
    $critica->getHilo()->incrementaNumLecturas();
    
    $this->otros        = $critica->getRelacionados();
    $this->noticia      = isset($critica->getHilo()->Noticia) ? $critica->getHilo()->getNoticia() : new tdhNoticia();
    $this->critica      = $critica;
    $this->nota         = $this->getUser()->isAuthenticated() ? new tdhClienteVotoCriticaForm($critica->getVotoUsuario($this->getUser())) : null;
  }
  
  public function executeLista(sfWebRequest $request)
  {    
    $this->lista = Doctrine::getTable('tdhCritica')->getPagerAutorizadas($request->getParameter('pagina'), array('seccion_slug' => $request->getParameter('seccion_slug')));
  }
  
  public function executeVotar(sfWebRequest $request)
  {
    if($request->isMethod('post'))
    {
      $critica = Doctrine::getTable('tdhCritica')->retrieveAutorizadoById($request->getParameter('id'));
      $nota = new tdhClienteVotoCriticaForm($critica->getVotoUsuario($this->getUser()), array('critica_id' => $critica->getId(), 'usuario_id' => $this->getUser()->getUserId()));
      $nota->bindAndSave($request->getParameter('voto'));
    }
    else
    {
      throw new Exception('Sitio de votación prohibido');
    }
    
    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('critica/nota', array('critica' => $critica, 'nota' => $nota));
    }
    else
    {
      return $this->redirect(sprintf('@tdh_critica?id=%s&slug=%s', $critica->getId(), $critica->getSlug()));
    }
  }
  
  /**
   * Muestra las capturas para una crítica en una galería.
   * 
   * @param sfWebRequest $request
   */
  public function executeCapturas(sfWebRequest $request)
  {
    $this->forward404Unless($critica = Doctrine::getTable('tdhCritica')->retrieveAutorizadoById($request->getParameter('id')));
    $this->nota         = $this->getUser()->isAuthenticated() ? new tdhClienteVotoCriticaForm($critica->getVotoUsuario($this->getUser())) : null;
    
    $this->critica = $critica;
  }
  
  /**
   * Muestra los vídeos de una crítica.
   *
   * @param sfWebRequest $request
  */
  public function executeVideos(sfWebRequest $request)
  {
    $this->forward404Unless($critica = Doctrine::getTable('tdhCritica')->retrieveAutorizadoById($request->getParameter('id')));
    $this->nota         = $this->getUser()->isAuthenticated() ? new tdhClienteVotoCriticaForm($critica->getVotoUsuario($this->getUser())) : null;
    
    $this->critica = $critica;
  }
}
