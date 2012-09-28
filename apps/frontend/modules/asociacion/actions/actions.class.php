<?php

/**
 * asociacion actions.
 *
 * @package    templodehecate
 * @subpackage asociacion
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class asociacionActions extends sfActions
{
  public function executeIndice(sfWebRequest $request)
  {
    $this->asociaciones = Doctrine::getTable('tdhAsociacion')->retrieveByOptionsList(array('usuario_id' => $this->getUser()->getUserId()));
    $this->usuarios     = Doctrine::getTable('ehAuthUser')->retrievePeticionesGrupoList();
    
    /*$this->socio        = $this->getUser()->isAuthenticated() ? 
      Doctrine::getTable('tdhAsociacion')->retrieveByUsuarioIdList($this->getUser()->getUserId())->toKeyValueArray('id', 'id') : 
      array();*/
  }
  
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($this->asociacion = Doctrine::getTable('tdhAsociacion')->findOneBySlug($request->getParameter('slug')));
  }
  
  public function executeEditar(sfWebRequest $request)
  {
    $this->forward404Unless($asociacion = Doctrine::getTable('tdhAsociacion')->findOneById($request->getParameter('id'))); // Comprobamos que existe la asociación
    $this->forward404Unless($asociacion->puedeEditarUsuario($this->getUser()));  // Comprobamos que el usuario está autorizado a editar la asocación
    
    $form = new tdhClienteAsociacionForm($asociacion);
    
    if($request->isMethod('post'))
    {
      if($form->bindAndSave($request->getParameter('asociacion'), $request->getFiles('asociacion')))
      {
        $this->getUser()->setFlash('exito', 'Se han grabado los datos de la asociación.');
        $this->redirect('@tdh_asociacion?slug='.$form->getObject()->getSlug());
      }
    }
    
    $this->form = $form;
  }
  
  public function executeNueva(sfWebRequest $request)
  {
    $form = new tdhClienteAsociacionForm();
    
    if($request->isMethod('post'))
    {
      if($form->bindAndSave($request->getParameter('asociacion'), $request->getFiles('asociacion')))
      {
        $this->redirect('@tdh_asociacion?slug='.$form->getObject()->getSlug());
      }
    }
    
    $this->form = $form;
  }
  
  public function executeSolicitud(sfWebRequest $request)
  {
    if(!$this->getUser()->isAuthenticated())
    {
      throw new Exception('El usuario no está identificado');
    }
    
    $this->forward404Unless($asociacion = Doctrine::getTable('tdhAsociacion')->findOneById($request->getParameter('id')));
    
    // Hacemos una petición de ingreso en la sociedad
    if($request->getParameter('ingresar') == 1)
    {
      // Añadimos una invitación para que lo gestionen los administradores
      if($asociacion->getAceptaInvitaciones() == 'invitaciones')
      {
        $ingreso = new tdhAsociacionInvitacion();
        
        $ingreso
          ->setUsuarioId($this->getUser()->getUserId())
          ->setAsociacionId($request->getParameter('id'))
          ->setEsDeUsuario(true)
          ->save();
      }
      // Ingresamos directamente al usuario
      elseif($asociacion->getAceptaInvitaciones() == 'abierto')
      {
        $ingreso = new tdhAsociacionUsuario();
        
        $ingreso
          ->setUsuarioId($this->getUser()->getUserId())
          ->setAsociacionId($request->getParameter('id'))
          ->save();
        
        $asociacion->setNumSocios($asociacion->getNumSocios()+1);
      }
      // Lanzamos un error, el usuario no debería estar aquí
      else
      {
        throw new Exception('No se puede modificar los usuarios de este grupo'); 
      }
      
    }
    // Damos de baja al socio
    else
    {
      if($ingreso = Doctrine::getTable('tdhAsociacionUsuario')->findOneByUsuarioIdAndAsociacionId($this->getUser()->getUserId(), $request->getParameter('id')))
      {
        $ingreso->delete();
        $asociacion->setNumSocios($asociacion->getNumSocios()-1);
      }
      elseif($invitacion = Doctrine::getTable('tdhAsociacionInvitacion')->findOneByUsuarioIdAndAsociacionId($this->getUser()->getUserId(), $request->getParameter('id')))
      {
        $invitacion->delete();
      }
    }
    
    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('botonUnirse', array('asociacion' => $asociacion));
    }
    else
    {
      $this->redirect('@tdh_asociacion?slug='.$asociacion->getSlug());
    }
  }
}
