<?php

/**
 * noticia actions.
 *
 * @package    templodehecate
 * @subpackage noticia
 * @author     Pablo Floriano
 */
class noticiaActions extends sfActions
{
  /**
   * Muestra una noticia según el parámetro ID.
   *
   * @param sfRequest $request A request object
   */
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($noticia = Doctrine::getTable('tdhNoticia')->retrieveAutorizadoById($request->getParameter('id')));
    $this->redirectUnless($noticia->esSoloNoticia(), $noticia->getRouting(), 301);
    
    // Redirigimos si la ruta no es la correcta
    $routing = $noticia->getRouting(true);
    $this->redirectUnless($this->generateUrl($routing['ruta'], $routing['parametros'], true) == $request->getUri(), $noticia->getRouting(), 301);
    
    // Incrementamos el número de lecturas
    $noticia->getHilo()->incrementaNumLecturas();
    
    $this->otros        = $noticia->getRelacionados();
    $this->noticia      = $noticia;
  }
  
  /**
   * Selecciona un listado de contenidos en función de un filtro y de la sección; ambos parámetros son opcionales.
   * Los valores válidos para los filtros son:
   *  * destacados/destacadas: muestra sólo las noticias destacadas.
   *  * staff: muestra únicamente las noticias publicadas por el staff de la sección, según la columna de ehForoHilo.
   * 
   * @param sfRequest $request A request object
   */
  public function executeLista(sfWebRequest $request)
  {    
    $opciones = array();
    
    if($request->hasParameter('filtro'))
    {
      $opciones['filtro'] = $request->getParameter('filtro');
    }
    
    if($request->hasParameter('seccion_slug'))
    {
      $opciones['seccion_slug'] = $request->getParameter('seccion_slug');
      $this->seccion = Doctrine::getTable('tdhSeccion')->retrieveAutorizadoBySlug($request->getParameter('seccion_slug'));
    }
    
    $opciones['solo_noticias'] = true;
    
    $this->lista = Doctrine::getTable('tdhNoticia')->getPagerAutorizadas($request->getParameter('pagina'), $opciones);
  }
}
