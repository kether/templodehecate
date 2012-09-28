<?php

class ehForoUsuariosActivosFilter extends sfFilter
{
  public function execute(sfFilterChain $filterChain)
  {    
    if(
      !$this->getContext()->getRequest()->isXmlHttpRequest()                              // no es una respuesta AJAX
      && $this->isFirstCall()                                                             // es la primera llamada
      && !in_array(
        $this->getContext()->getModuleName().'/'.$this->getContext()->getActionName(),    // módulo/acción actual
        $this->getParameter('excluir', array())))                                         // buscamos en este array si coinicide con el módulo/acción
    {
      
      try
      {
        $user = $this->getContext()->getUser();  
        if(!$usuarioActivo = Doctrine::getTable('ehForoUsuarioActivo')->findOneByIp($user->getIp()))
        {
          $usuarioActivo = new ehForoUsuarioActivo();
        }
        $usuarioActivo->actualizarRegistro($this->getContext());
      }
      catch(Exception $e)
      {
        $this->getContext()->getLogger()->info('Error en ehForoUsuariosActivosFilter: '.$e);
      }
    }
    
    $filterChain->execute();
  }
}