<?php

/**
 * Clase padre de sfApplicationConfiguration que permite generar URLs de aplicaciones cruzadas del mismo proyecto.
 * Para disponer de esta funcionalidad incluye este fichero en el fichero applicationConfiguracion.class.php de tu aplicación:
 * 
 *  require_once dirname(__FILE__).'/../../../plugins/ehUtilesPlugin/lib/ehUtilesApplicationConfiguration.class.php';
 *   
 * Luego modifica la clase que extiende (sfApplicationConfiguration) por (ehUtilesApplicationConfiguration).
 * Finalmente en el fichero app.yml añade las rutas absolutas a las rutas de las aplicaciones que quieras acceder de este modo:
 * 
 *  app_route_application_absolute: http://www.example.com/application_env.php
 *  
 * Dónde "application" debe ser el nombre de la aplicación (frontend, backend, etc.) y "env" debe ser el nombre del entorno.
 * 
 * @package ehUtilesPlugin
 * @author Pablo Floriano <p.floriano@estudiohecate.com>
 */
abstract class ehUtilesApplicationConfiguration extends sfApplicationConfiguration
{
  protected $routes = array();
  
  protected $zendAutoloader = false;
  
  /**
   * Devuelve la ruta absoluta en la aplicación especificada. Se puede usar desde cualquier acción con $this->getContext()->getConfiguration()->generaUrlFromApp() o
   * desde cualquier otra parte con sfProjectConfiguration::getActive()->generaUrlFromApp().
   * 
   * @param string $app Nombre de la aplicación (p.e.: frontend, backend, etc.)
   * @param string $name Nombre de la ruta definido en routing.yml (p.e.: homepage).
   * @param array $parameters Array de variables que se pasarán a la acción.
   * @return string Una ruta absoluta.
   */
  public function generaUrlFromApp($app, $name, $parameters = array())
  {
    return sfConfig::get('app_route_'.$app.'_absolute').$this->getRoutingFromApp($app)->generate($name, $parameters);
  }
  
  protected function getRoutingFromApp($app)
  {
    if (!isset($this->routes[$app]))
    {
      $this->routes[$app] = new sfPatternRouting(new sfEventDispatcher());

      $config = new sfRoutingConfigHandler();
      $routes = $config->evaluate(array(sfConfig::get('sf_apps_dir')."/$app/config/routing.yml"));
      $this->routes[$app]->setRoutes($routes);
    }
    
    return $this->routes[$app];
  }
  
  protected function getLockFilePath($app = null)
  {
    return sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.($app ? $app : $this->getApplication()).'_'.$this->getEnvironment().'.lck';
  }
  
  /**
   * Comprueba si la aplicación está bloqueada.
   * 
   * @param string $app Nombre de la aplicación (p.e.: frontend, backend, etc.)
   * @return boolean
   */
  public function isLockApp($app = null)
  {
    return $this->hasLockFile($this->getLockFilePath($app));
  }
  
  /**
   * Deshabilita la aplicación con el entorno por defecto.
   * 
   * @param string $app Nombre de la apliación. Si no se especifica selecciona la aplicación por defecto
   */
  public function disableApp($app = null)
  {
    try
    {
      file_put_contents($this->getLockFilePath($app), '');
    }
    catch(Exception $e)
    {
      throw new Exception('No se pudo bloquear la aplicación.');
    }
  }
  
  /**
   * Rehabilita la aplicación con el entorno por defecto.
   * 
   * @param string $app Nombre de la apliación. Si no se especifica selecciona la aplicación por defecto
   */
  public function enableApp($app = null)
  {
    try
    {
      if($this->hasLockFile($this->getLockFilePath($app)))
      {
        unlink($this->getLockFilePath($app));
      }
    }
    catch(Exception $e)
    {
      throw new Exception('No se pudo desbloquear la aplicación.');
    }
  }
  
  public function registerZend()
  {
    if(!$this->zendAutoloader)
    {
      set_include_path(implode(PATH_SEPARATOR, array(
        sfConfig::get('app_eh_utiles_plugin_zend_dir'),
        get_include_path()
      )));
      
      require_once('Zend/Loader/Autoloader.php');
      
      $this->zendAutoloader = Zend_Loader_Autoloader::getInstance();
    }
    
    return $this->zendAutoloader;
  }
}