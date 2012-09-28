<?php

/**
 * indice actions.
 *
 * @package    templodehecate
 * @subpackage indice
 * @author     Pablo Floriano
 */
class indiceActions extends sfActions
{
  /**
   * Muestra la portada con todos sus contenidos.
   *
   * @param sfRequest $request
   */
  public function executePortada(sfWebRequest $request)
  {
    if($this->getUser()->isAuthenticated())
    {
      $this->favoritos = $this->getUser()->getAuthUser()->getMisSeccionesFavoritas();
    }
    
    // Lo quitamos hasta que terminemos el sistema de móviles
    /*
    if($this->getUser()->isFirstRequest())
    {
      if($this->getUser()->getAgent()->isMobile())
      {
        $this->redirect('@homepage?mobile=1');
      }
    }
    
    if($request->hasParameter('mobile'))
    {
      $this->setLayout('layoutMobile');
      $this->setTemplate('portadaMobile');
    }
    */
  }
  
  /**
   * Realice una búsqueda en los contenidos del sitio web.
   * 
   * @param sfWebRequest $request
   */
  public function executeBuscar(sfWebRequest $request)
  {
    // Queremos mostrar el fichero de configuración para las búsquedas si el formato es javascript
    if($request->getParameter('sf_format') == 'js')
    {
      return sfView::SUCCESS;
    }
    
    $this->redirectUnless($request->getParameter('q'), '@homepage');
    
    $this->resultados = tdhContenidoTable::getContenidoBusqueda($request->getParameter('q'));
    
    // Si es una consulta AJAX
    if ($request->isXmlHttpRequest())
    {
      if ('*' == $request->getParameter('q') || !$this->resultados)
      {
        return $this->renderText('No se encontraron contenidos.');
      }
      else
      {
        return $this->renderPartial('indice/listaContenidos', array('resultados' => $this->resultados));
      }
    }
    
    // Si tan sólo hay un resultado redireccionamos directamente al contenido
    if($this->resultados->count() == 1)
    {
      $resultado = $this->resultados->getFirst();
      $this->redirect($resultado->getRouting());
    }
  }
  
  /**
   * Genera una hoja de alimentación Atom 1.0 con Zend_Feed_Writer de todas las actualizaciones
   * de la web, incluyendo: noticias, recursos, eventos y críticas.
   * 
   * @param sfWebRequest $request
   */
  public function executeFeed(sfWebRequest $request)
  {
    $this->getContext()->getConfiguration()->registerZend();
    $feed = new Zend_Feed_Writer_Feed();
    
    $feed->setDescription(tdhConfig::get('lema'));
    $feed->setGenerator(tdhConfig::get('nombre'), tdhConfig::get('version'));
    $feed->setLanguage($this->getUser()->getCulture());
    $feed->setDateModified(time());
    
    $prefijoImagen = '';
    switch($request->getParameter('tipo'))
    {
      // Agenda de actividades
      case 'eventos':
        $feed->setTitle(sprintf('Próximos eventos en la agenda de %s', tdhConfig::get('nombre')));
        $feed->setFeedLink($this->generateUrl('tdh_feed', array('tipo' => 'eventos'), true), 'atom');
        $feed->setLink($this->generateUrl('tdh_evento_lista', array(), true));
        $contenidos = Doctrine::getTable('tdhEvento')->getAutorizados(tdhConfig::get('contenidos_por_pagina'), array('solo_proximos' => true));
        break;
      case 'noticias':
        $feed->setTitle(sprintf('Noticias en %s', tdhConfig::get('nombre')));
        $feed->setFeedLink($this->generateUrl('tdh_feed', array('tipo' => 'noticias'), true), 'atom');
        $feed->setLink($this->generateUrl('tdh_noticia_lista', array(), true));
        $contenidos = Doctrine::getTable('tdhNoticia')->getAutorizados(tdhConfig::get('contenidos_por_pagina'));
        break;
      case 'recursos':
        $feed->setTitle(sprintf('Ayudas y módulos en %s', tdhConfig::get('nombre')));
        $feed->setFeedLink($this->generateUrl('tdh_feed', array('tipo' => 'recursos'), true), 'atom');
        $feed->setLink($this->generateUrl('tdh_recurso_lista', array(), true));
        $contenidos = Doctrine::getTable('tdhRecurso')->getAutorizados(tdhConfig::get('contenidos_por_pagina'));
        $prefijoImagen = 'cov';
        break;
      case 'criticas':
        $feed->setTitle(sprintf('Reseñas en %s', tdhConfig::get('nombre')));
        $feed->setFeedLink($this->generateUrl('tdh_feed', array('tipo' => 'criticas'), true), 'atom');
        $feed->setLink($this->generateUrl('tdh_critica_lista', array(), true));
        $contenidos = Doctrine::getTable('tdhCritica')->getAutorizados(tdhConfig::get('contenidos_por_pagina'));
        break;
      // Todos
      case 'general':
      default:
        $feed->setTitle(sprintf('Actualizaciones de %s', tdhConfig::get('nombre')));
        $feed->setFeedLink($this->generateUrl('tdh_feed', array(), true), 'atom');
        $feed->setLink($this->generateUrl('homepage', array(), true));
        $contenidos = tdhContenidoTable::getContenidoUltimos();
        break;
    }
    
    foreach($contenidos as $contenido)
    {
      $entry = $feed->createEntry();
      
      if($request->getParameter('tipo') != 'general')
      {
        $imagen = $contenido->hasImage($prefijoImagen.'gra') ? $contenido->getImagePath($prefijoImagen.'gra') : $contenido->getImagePath($prefijoImagen.'med', true);
        $contenido = $contenido->getHilo();
      }
      else
      {
        $imagen = $contenido->hasContenidoImage($prefijoImagen.'gra') ? $contenido->getContenidoImagePath($prefijoImagen.'gra') : $contenido->getContenidoImagePath($prefijoImagen.'med', true);
      }
      
      $imagen = $imagen ? '<p><img src="'.$this->generateUrl('homepage', array(), true).$imagen.'" alt="'.$contenido->getPrimerMensaje()->getAsunto().'" /></p>' : '';
      
      $entry->setTitle($contenido->getPrimerMensaje()->getAsunto());
      $entry->setDescription($imagen.$contenido->getPrimerMensaje()->getCuerpoHtml());
      $entry->setLink($this->getController()->genUrl($contenido->getRouting(), true));
      $entry->setDateModified(strtotime($contenido->getPrimerMensaje()->getUpdatedAt()));
      $entry->setDateCreated(strtotime($contenido->getPrimerMensaje()->getVisibleDesde()));
      $entry->addAuthor(array(
        'name'  => $contenido->getPrimerMensaje()->getNick(),
        'uri'   => $this->generateUrl('eh_foro_perfil', array('username' => $contenido->getPrimerMensaje()->getUsuario()->getUsername()), true)
      ));
      
      if($contenido->getRespuestas())
      {
        $entry->setCommentCount($contenido->getRespuestas());
      }
      
      $feed->addEntry($entry);
    }
    
    $this->feed = $feed->export('atom');
  }
  
  /**
   * Muestra una página de advertencia de sitio no encontrado.
   * 
   * @param sfWebRequest $request
   */
  public function executeError404(sfWebRequest $request)
  {
    $this->setLayout('layoutError');
  }
  
  /**
   * Muestra una página de advertencia informando de que el módulo que intenta ver está deshabilitado en la aplicación.
   * 
   * @param sfWebRequest $request
   */
  public function executeDeshabilitado(sfWebRequest $request)
  {
  }
}
