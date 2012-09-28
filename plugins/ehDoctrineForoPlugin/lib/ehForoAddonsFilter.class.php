<?php

class ehForoAddonsFilter extends sfFilter
{
  protected $addons = array();
  
  public function execute(sfFilterChain $filterChain)
  {
    $filterChain->execute();
    
    foreach($this->addons as $metodo)
    {
      // Ejecutamos el método del filtro
      $metodo = $metodo.'Addon';
      $this->$metodo();
    }
  }
  
  protected function sustituir($tagComentario, $textSustituto, $preComentario = false)
  {
    $this->getContext()->getResponse()
      ->setContent(str_ireplace($tagComentario, $preComentario ? $tagComentario.$textSustituto : $textSustituto.$tagComentario, $this->getContext()->getResponse()->getContent()));
  }
  
  /**
   * Comprueba si el módulo y la acción del contexto es la misma.
   * 
   * @param string $action
   * @param string $module
   */
  protected function checkModuleAction($module, $action)
  {
    return $this->getContext()->getModuleName() == $module && $this->getContext()->getActionName() == $action;
  }
}