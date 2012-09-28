<?php

/**
 * recurso actions.
 *
 * @package    templodehecate
 * @subpackage recurso
 * @author     Pablo Floriano
 */
class recursoActions extends sfActions
{
  /**
   * Muestra el contenido según el parámetro ID.
   *
   * @param sfRequest $request A request object
   */
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($recurso = Doctrine::getTable('tdhRecurso')->retrieveAutorizadoById($request->getParameter('id')));
    
    // Redirigimos si la ruta no es la correcta
    $routing = $recurso->getRouting(true, $request->getParameter('sf_format', 'html'));
    $this->redirectUnless($this->generateUrl($routing['ruta'], $routing['parametros'], true) == $request->getUri(), $recurso->getRouting(), 301);
    
    // Incrementamos el número de lecturas
    $recurso->getHilo()->incrementaNumLecturas();
    
    $this->otros        = $recurso->getRelacionados();
    $this->noticia      = isset($recurso->getHilo()->Noticia) ? $recurso->getHilo()->getNoticia() : new tdhNoticia;    
    $this->recurso      = $recurso;
    
    if($request->getParameter('sf_format') == 'epub')
    {
      $epub = new ehUtilesEPub();
      $routing['parametros']['sf_format'] = 'html';
      
      // Añadimos el autor
      if($recurso->getAutor())
      {
        $epub->setAutor($recurso->getAutor());
      }
      
      // Añadimos la portada
      if($recurso->hasImage('covgra'))
      {
        $epub->setPortada($recurso->getImagePath('covgra'));
      }
      
      // Cubierta
      $cubierta = '<div id="entradilla">'.$recurso->getEntradilla().'</div><div id="tipo">'.$recurso->getTipo().' para '.$recurso->getSeccion().'</div>';
      
      $epub
        ->setTitulo($recurso->getTitular())
        ->setEditor(tdhConfig::get('nombre'), $this->generateUrl('homepage', array(), true))
        ->setUrl($this->generateUrl($routing['ruta'], $routing['parametros'], true))
        ->setEtiquetas($recurso->getSeccion().', '.$recurso->getTipo())
        ->setDerechos($recurso->getLicencia())
        ->setFecha($recurso->getMensaje()->getUpdatedAt())
        ->addCubierta($cubierta, $recurso->getTitular())
        ->addCapitulo($recurso->getMensaje()->getCuerpoHtml(), 'Capítulo único', 'capitulo.html');
            
      return $epub->publicarYEnviar();
    }
    else
    {
      // Donaciones
      $paypal = new ehPaypalIpn();
      
      $paypal
        ->addField('cmd', '_xclick')
        ->addField('custom', $recurso->getId())
        ->addField('notify_url', $this->generateUrl('tdh_recurso_ipn', array('usuario_id' => $this->getUser()->getUserId()), true))
        ->addField('return', $this->generateUrl('tdh_recurso_donacion_resultado', array('id' => $recurso->getId(), 'resultado' => 'si'), true))
        ->addField('cancel', $this->generateUrl('tdh_recurso_donacion_resultado', array('id' => $recurso->getId(), 'resultado' => 'no'), true))
        ->addField('item_name', 'Donacion para '.$recurso->getTitular().' por '.$recurso->getAutor())
        ->addField('amount', 1.00, ehPaypalField::TYPE_RADIO, array('1.00' => '€1,00', '2.00' => '€2,00', '5.00' => '€5,00'))
        ->addField('business', in_array($this->getContext()->getConfiguration()->getEnvironment(), array('prod', 'beta')) ? $recurso->getPaypal() : null)
        ->getField('amount')->setLabel('Cantidad');
      
      $this->donacion_form = $paypal->getForm();
      $this->paypal        = $paypal;
    }
  }
  
  public function executeLista(sfWebRequest $request)
  {
    $this->lista = Doctrine::getTable('tdhRecurso')->getPagerAutorizadas(
      $request->getParameter('pagina'), 
      array(
      	'favorito_ruser_id' => $this->getUser()->getUserId(), 
      	'seccion_slug'      => $request->getParameter('seccion_slug'),
      	'perfil'            => $request->getParameter('perfil')
      )
    );
    
    if($request->hasParameter('seccion_slug'))
    {
      $opciones['seccion_slug'] = $request->getParameter('seccion_slug');
      $this->seccion = Doctrine::getTable('tdhSeccion')->retrieveAutorizadoBySlug($request->getParameter('seccion_slug'));
    }
  }
  
  /**
  * Añade o suprime un recurso en la lista de favoritos del usuario.
  *
  * @param sfWebRequest $request
  */
  public function executeFavorito(sfWebRequest $request)
  {
    // Buscamos si existe la relación de favorito
    $relacion = Doctrine::getTable('tdhRecursoFavorito')->findOneByUsuarioIdAndRecursoId(
      $this->getUser()->getUserId(),
      $request->getParameter('recurso_id')
    );
  
    // Queremos añadir el recurso a favoritos
    if($request->getParameter('opcion') == 1)
    {
      if(!$relacion)
      {
        $relacion = new tdhRecursoFavorito();
        $relacion
          ->setUsuarioId($this->getUser()->getUserId())
          ->setRecursoId($request->getParameter('recurso_id'))
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
      return $this->renderPartial('recurso/favorito', array(
        'recurso_id'  => $request->getParameter('recurso_id'),
        'es_favorito' => $request->getParameter('opcion')
      ));
    }
    else
    {
      $recurso = Doctrine::getTable('tdhRecurso')->retrieveAutorizadoById($request->getParameter('recurso_id'));
      $this->redirect('@tdh_recurso?slug='.$recurso->getHilo()->getPrimerMensaje()->getSlug().'&id='.$recurso->getId());
    }
  }
    
  /**
   * Para gestionar la donaciones mediante PayPal y marcarlo en el recurso
   * 
   * @param sfWebRequest $request
   */
  public function executeIpn(sfWebRequest $request)
  {
    $paypal = new ehPaypalIpn();
    
    if($paypal->validateIpn())
    {
      /**
			 * @var tdhRecurso
       */
      $recurso = Doctrine::getTable('tdhRecurso')->findOneById($paypal->getIpnData('custom'));
      
      // Anotamos el donativo en el recurso
      $recurso
        ->setNumDonativos($recurso->getNumDonativos()+1)
        ->setCantidadDonativos($recurso->getCantidadDonativos() + $paypal->getIpnData('mc_gross'))
        ->save();
      
      if($request->getParameter('usuario_id'))
      {
        $usuario = Doctrine::getTable('ehAuthUser')->findOneById($request->getParameter('usuario_id'));
        
        $usuario->getPerfil()
          ->setSinPubliHasta(date('Y-m-d', time() + tdhConfig::get('tiempo_sinpubli_donacion', 2592000)))
          ->save();
        
        $donacion = new tdhDonacion();
        
        $donacion
          ->setHiloId($recurso->getHilo()->getId())
          ->setUsuarioId($usuario->getId())
          ->setCantidad((float) $paypal->getIpnData('mc_gross'))
          ->save();
      }
      
    }
    
    return sfView::HEADER_ONLY;
  }
  
  public function executeResultadoDonacion(sfWebRequest $request)
  {
    $this->forward404Unless($recurso = Doctrine::getTable('tdhRecurso')->retrieveAutorizadoById($request->getParameter('id')));
    
    $this->getUser()->setFlash('success', 'Su donación ha sido recibida, ¡muchas gracias!');
    $this->getUser()->setearSinPublicidad();
    
    $this->redirect($recurso->getRouting());
  }
  
  public function executeFavoritos(sfWebRequest $request)
  {
    $this->setLayout(false);
  }
}
