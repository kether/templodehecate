<?php

/**
 * publicidad actions.
 *
 * @package    templodehecate
 * @subpackage publicidad
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class publicidadActions extends sfActions
{
  /**
   * Redirecciona una URL de publicidad.
   * 
   * @param sfWebRequest $request
   */
  public function executeUrl(sfWebRequest $request)
  {
    /**
     * @var tdhAnuncio
     */
    $anuncio = Doctrine::getTable('tdhAnuncio')->findOneById($request->getParameter('id'));
    
    $anuncio->setClicks($anuncio->getClicks()+1)->save();
    
    // redirigimos a la web
    $this->redirect($anuncio->getUrl());
  }
  
  /**
   * Página de información sobre promociones y precios para poner anuncios en el sitio web.
   * 
   * @param sfWebRequest $request
   */
  public function executePromo(sfWebRequest $request)
  {
    $this->articulo = Doctrine::getTable('tdhArticulo')->retrieveAutorizadoBySlug(tdhConfig::get('publicidad_articulo'));
    
    $this->anuncios = tdhConfig::get('publicidad_costes'); 
  }
  
  public function executeFormulario(sfWebRequest $request)
  {
    $tipos = tdhConfig::get('publicidad_costes');
    $this->forward404Unless(isset($tipos[$request->getParameter('tipo')]));
    
    $tipo = $tipos[$request->getParameter('tipo')];
    
    if($request->hasParameter('id'))
    {
      $this->forward404Unless($anuncio = Doctrine::getTable('tdhAnuncio')->findOneBy('id', $request->getParameter('id')));
      $form = new tdhClientePublicidadForm($anuncio, array('tipo' => $tipo));
      
      if($form->esPagado())
      {
        $this->redirect('@tdh_publicidad_mostrar?id='.$anuncio->getId());
      }
      elseif($form->esPagable())
      {
        $this->paypal = new ehPaypalIpn();
        $this->precio = $tipo['precio'];
        
        $this->paypal
          ->addField('cmd', '_xclick')
          ->addField('custom', $anuncio->getId())
          ->addField('notify_url', $this->generateUrl('tdh_publicidad_ipn', array('usuario_id' => $this->getUser()->getUserId()), true))
          ->addField('return', $this->generateUrl('tdh_publicidad_mostrar', array('id' => $anuncio->getId(), 'resultado' => 'si'), true))
          ->addField('cancel', $this->generateUrl('tdh_publicidad_mostrar', array('id' => $anuncio->getId(), 'resultado' => 'no'), true))
          ->addField('item_name', 'Pago por promocion')
          ->addField('currency_code', $tipo['moneda'])
          ->addField('amount', $this->precio);
      }
    }
    else
    {
      $form = new tdhClientePublicidadForm(null, array('tipo' => $tipo));
    }
    
    if($request->isMethod('post'))
    {
      if($form->bindAndSave($request->getParameter('anuncio'), $request->getFiles('anuncio')))
      {
        $this->redirect('@tdh_publicidad_contratar?tipo='.$request->getParameter('tipo').'&id='.$form->getObject()->getId());
      }
    }
    
    $this->form = $form;
  }
  
  public function executeIpn(sfWebRequest $request)
  {
    $paypal = new ehPaypalIpn();
    
    if($paypal->validateIpn())
    {
      /**
       * @var tdhAnuncio
       */
      $anuncio = Doctrine::getTable('tdhAnuncio')->findOneBy('id', $paypal->getIpnData('custom'));
      
      $pago = $anuncio->getPago();
      $pago
        ->setCantidad((float) $paypal->getIpnData('mc_gross'))
        ->setUsuarioId($request->getParameter('usuario_id'))
        ->save();
      
      $anuncio->setActivo(true)->save();
    }
    
    return sfView::HEADER_ONLY;
  }
  
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($this->anuncio = Doctrine::getTable('tdhAnuncio')->retrieveOneById($request->getParameter('id')));
    
    if($request->hasParameter('resultado'))
    {
      if($request->getParameter('resultado') == 'si')
      {
        $this->getUser()->setFlash('exito', 'Su promoción ha sido dada de alta en nuestra base de datos.');
        $this->redirect('@tdh_publicidad_mostrar?id='.$this->anuncio->getId());
      }
      else
      {
        $this->getUser()->setFlash('error', 'Ocurrió un error en la confirmación de pago. Deberá comenzar con un nuevo anuncio o consultarnos en nuestra página de contacto.');
        $this->anuncio->delete();
        $this->redirect('@tdh_publicidad_promocion');
      }
    }
    
    if($this->anuncio->isPagado())
    {
      $this->forward404Unless($this->anuncio->getPago()->getUsuarioId() == $this->getUser()->getUserId() || $this->getUser()->isAdministrador());
    }
  }
}
