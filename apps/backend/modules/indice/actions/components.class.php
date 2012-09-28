<?php

class indiceComponents extends sfComponents
{
  /**
   * El componente menuPrincipal extrae del fichero menu.yml del directorio de configuración de la aplicación un array asociativo
   * con las opciones de menú de la aplicación.
   * En una segunda fase la acción hace un bucle por todos los menus y en caso de encontrar correspondencia entre un menú
   * y un "módulo/acción" o bien un "módulo/*" (debe corresponder el módulo pero es válida cualquier acción) especificado en el
   * fichero menu.yml, marca la opción de menú con foco. Además introduce en la variable $submenu el array de opciones de la opción
   * con foco.
   * Finalmente entre la primera opción del menú y todas las demás buscaremos en la tabla tdhMenu de la BD opciones adicionales
   * que se quieran poner en el menú de forma dinámica desde el backend. 
   * 
   * La plantilla _menuPrincipal.php podrá acceder a las siguientes variables:
   *  * (array) $menuPrincipal: Las opciones del menú principal
   *  * (array) $submenuPrincipal: Las opciones asociadas al menú con foco
   * 
   * @param sfWebRequest $request
   */
  public function executeMenuPrincipal(sfWebRequest $request)
  {
    // Extraemos el array del menu    
    $menus = sfYaml::load(sfConfig::get('sf_app_config_dir').'/menu.yml');
        
    $accionModulo = $request->getParameterHolder()->get('module').'/'.$request->getParameterHolder()->get('action');
    $moduloGeneral = $request->getParameterHolder()->get('module').'/*';
    $submenuPrincipal = array();
    $foco = false;
    
    // Miramos todos los menus
    foreach($menus as $key => $menu)
    {
      if(!$submenuPrincipal)
      {
        $valido = isset($menu['valido']) ? $menu['valido'] : array();
        if(in_array($moduloGeneral, $valido) || in_array($accionModulo, $valido))
        {         
          $foco = true;
          $submenuPrincipal = isset($menu['submenus']) ? $menu['submenus'] : array();
        }
      }
      
      $menuPrincipal[$key] = array('nombre'  => $menu['nombre'], 'uri' => $menu['uri'], 'foco' => $foco, 'especial' => false);
      
      $foco = false;
    }
    
    $this->menuPrincipal      = $menuPrincipal;
    $this->submenuPrincipal   = $submenuPrincipal;
  }
}