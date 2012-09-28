<?php

/**
 * seccion actions.
 *
 * @package    templodehecate
 * @subpackage seccion
 * @author     Pablo Floriano
 */
class seccionActions extends sfActions
{  
  /**
   * Ejecuta la acción índice.
   *
   * @param sfRequest $request A request object
   */
  public function executeIndice(sfWebRequest $request)
  {
    $this->forward404Unless($this->seccion = Doctrine::getTable('tdhSeccion')->retrieveAutorizadoBySlug($request->getParameter('seccion_slug')));
    
    $this->noticias      = $this->seccion->getContenidosPorTabla('Noticia');
    $this->recursos      = $this->seccion->getContenidosPorTabla('Recurso');
    $this->criticas      = $this->seccion->getContenidosPorTabla('Critica');
    $this->foro          = Doctrine::getTable('ehForoHilo')->retrieveAutorizados(5, $this->seccion->getTablonId());
    $this->colaboradores = Doctrine::getTable('ehAuthUser')->retrieveColaboradoresBySeccion($this->seccion->getId());
        
    if($this->getUser()->esColaborador($this->seccion->getSlug()))
    {
      $this->noticiasDes = $this->seccion->getDesautorizadosPorTabla('Noticia');
      $this->recursosDes = $this->seccion->getDesautorizadosPorTabla('Recurso');
      $this->criticasDes = $this->seccion->getDesautorizadosPorTabla('Critica');
    }
    
    if($this->criticaBasica = $this->seccion->getCriticaBasico())
    {
      $this->nota     = $this->getUser()->isAuthenticated() ? new tdhClienteVotoCriticaForm($this->criticaBasica->getVotoUsuario($this->getUser())) : null;
    }
  }
  
  /**
   * Muestra un listado de secciones ordenados alfabéticamente.
   * 
   * @param sfRequest $request
   */
  public function executeLista(sfWebRequest $request)
  {
    $opciones = array(
      'tipo'          => $request->getParameter('tipo'),
      'genero'        => $request->getParameter('genero'),
      'letra'         => $request->getParameter('letra'),
      'usuario_id'    => $this->getUser()->getUserId(),
      'orden'         => 'popular'
    );
    
    if($this->getUser()->isAuthenticated())
    {
      $this->favoritos = $this->getUser()->getAuthUser()->getMisSeccionesFavoritas();
    } 
    $this->pager   = Doctrine::getTable('tdhSeccion')->getPagerAutorizados($request->getParameter('pagina', 1), $opciones);
    $this->abc     = '#ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  }
  
  /**
   * Añade o suprime una sección en la lista de favoritos del usuario.
   * 
   * @param sfWebRequest $request
   */
  public function executeFavorito(sfWebRequest $request)
  {    
    // Buscamos si existe la relación de favorito
    $relacion = Doctrine::getTable('tdhSeccionFavorita')->findOneByUsuarioIdAndSeccionId(
      $this->getUser()->getUserId(),
      $request->getParameter('seccion_id')
    );
      
    // Queremos añadir la sección a favoritos
    if($request->getParameter('opcion') == 1)
    {
      if(!$relacion)
      {
        $relacion = new tdhSeccionFavorita();
        $relacion
          ->setUsuarioId($this->getUser()->getUserId())
          ->setSeccionId($request->getParameter('seccion_id'))
          ->save();
      }
    }
    // Queremos suprimirla de favoritos
    else
    {
      if($relacion)
      {
        $relacion->delete();
      }
    }
    
    /*
     * Si es un acceso ajax generamos el parcial y si no nos vamos a la sección
     */
    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('seccion/favorito', array(
        'seccion_id'  => $request->getParameter('seccion_id'),
        'es_favorito' => $request->getParameter('opcion')
      ));
    }
    else
    {
      $seccion = Doctrine::getTable('tdhSeccion')->findOneById($request->getParameter('seccion_id'));
      $this->redirect('@tdh_seccion?seccion_slug='.$seccion->getSlug());
    }
  }
  
  public function executeGrabarComentario(sfWebRequest $request)
  {
    $form = new tdhComentarioForm(null, array('user' => $this->getUser()));
    
    // Grabamos un nuevo mensaje
    if($request->isMethod('post'))
    {
      $form->bindAndSave($request->getParameter('eh_foro_mensaje'));
      $hilo_id = $form->getValue('hilo_id');
    }
    // Queremos borrar el mensaje
    elseif($request->hasParameter('remove_mensaje_id'))
    {
      $mensaje = Doctrine::getTable('ehForoMensaje')->retrieveAutorizadoPorId($request->getParameter('remove_mensaje_id'), $this->getUser()->getUserId());
      $hilo = $mensaje->getHilo();
      
      if($mensaje->estaUsuarioAutorizado($this->getUser(), ehForoMensaje::NIVEL_ACCESO_MODERADOR))
      {
        $mensaje->delete();
      }
      else
      {
        throw new sfException('No estás autorizado para eliminar mensajes');
      }
    }
    
    if($request->isXmlHttpRequest())
    {
      $hilo = isset($hilo) ? $hilo : Doctrine::getTable('ehForoHilo')->retrieveAutorizadoPorId($hilo_id);
      
      if($hilo instanceOf ehForoHilo)
      {
        return $this->renderPartial('seccion/comentarios', array('hilo' => $hilo));
      }
      else
      {
        throw new sfException('No se encontró el hilo según el identificador: '.$request->hasParameter('hilo_id') ? $request->getParameter('hilo_id') : $form->getValue('hilo_id'));
      }
    }
    else
    {
      if($request->hasParameter('url_return'))
      {
        return $this->redirect($request->getParameter('url_return'));
      }
      else
      {
        throw new sfException('No es una consulta XMLHttpRequest');
      }
    }
  }
  
  public function executeNuevaNoticia(sfWebRequest $request)
  {
    $form = new tdhClienteNoticiaForm($request->getParameter('contenido_id') ? Doctrine::getTable('ehForoHilo')->retrievePorId($request->getParameter('contenido_id')) : null);
    
    if($request->isMethod('post'))
    {
      if($form->bindAndSave($request->getParameter('noticia'), $request->getFiles('noticia')))
      {
        $this->getUser()->setFlash('exito', 'Se guardó la noticia.');
      }
      else
      {
        $this->getUser()->setFlash('error', 'No se pudo guardar la noticia.');
      }
    }
    
    if(!$request->isXmlHttpRequest())
    {
      $this->redirect('@tdh_seccion?seccion_slug='.$request->getParameter('seccion_slug'));
    }
    
    $this->form = $form;
  }
  
  public function executeNuevoRecurso(sfWebRequest $request)
  {
    $form = new tdhClienteRecursoForm($request->getParameter('contenido_id') ? Doctrine::getTable('ehForoHilo')->retrievePorId($request->getParameter('contenido_id')) : null);
  
    if($request->isMethod('post'))
    {
      if($form->bindAndSave($request->getParameter('recurso'), $request->getFiles('recurso')))
      {
        $this->getUser()->setFlash('exito', 'Se guardó el recurso.');
      }
      else
      {
        $this->getUser()->setFlash('error', 'No se pudo guardar el recurso.');
      }
    }
  
    if(!$request->isXmlHttpRequest())
    {
      $this->redirect('@tdh_seccion?seccion_slug='.$request->getParameter('seccion_slug'));
    }
  
    $this->form = $form;
  }
  
  public function executeNuevaCritica(sfWebRequest $request)
  {
    $form = new tdhClienteCriticaForm($request->getParameter('contenido_id') ? Doctrine::getTable('ehForoHilo')->retrievePorId($request->getParameter('contenido_id')) : null);
  
    if($request->isMethod('post'))
    {
      if($form->bindAndSave($request->getParameter('critica'), $request->getFiles('critica')))
      {
        $this->getUser()->setFlash('exito', 'Se guardó la reseña.');
      }
      else
      {
        $this->getUser()->setFlash('error', 'No se pudo guardar la crítica.');
      }
    }
  
    if(!$request->isXmlHttpRequest())
    {
      $this->redirect('@tdh_seccion?seccion_slug='.$request->getParameter('seccion_slug'));
    }
  
    $this->form = $form;
  }
}
