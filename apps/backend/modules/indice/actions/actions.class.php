<?php

require_once(sfConfig::get('sf_plugins_dir').'/ehDoctrineAuthPlugin/modules/ehAuthLogin/lib/BaseehAuthLoginActions.class.php');

/**
 * Acciones del índice del panel de control
 *
 * @package    templodehecate
 * @subpackage indice
 * @author     Pablo Floriano
 */
class indiceActions extends BaseehAuthLoginActions
{
  
  protected $apps = array('frontend', 'backend');
  
  /**
   * Muestra la portada del panel de control del emplazamiento
   *
   * @param sfRequest $request A request object
   */
  public function executePortada(sfWebRequest $request)
  {
    $this->des_noticias = Doctrine::getTable('tdhNoticia')->countDesautorizados();
    $this->des_criticas = Doctrine::getTable('tdhCritica')->countDesautorizados();
    $this->des_recursos = Doctrine::getTable('tdhRecurso')->countDesautorizados();
    $this->des_eventos  = Doctrine::getTable('tdhEvento')->countDesautorizados();
  }
  
  public function executeGlobal(sfWebRequest $request)
  {
    $menus = sfYaml::load(sfConfig::get('sf_app_config_dir').'/menu.yml');
    
    $this->menu = $menus['global'];
  }
  
  public function executeContenidos(sfWebRequest $request)
  {
    $menus = sfYaml::load(sfConfig::get('sf_app_config_dir').'/menu.yml');
    
    $this->menu = $menus['contenidos'];
  }
  
  public function executeForo(sfWebRequest $request)
  {
    $menus = sfYaml::load(sfConfig::get('sf_app_config_dir').'/menu.yml');
  
    $this->menu = $menus['foro'];
  }
  
  public function executeSorteos(sfWebRequest $request)
  {
    $menus = sfYaml::load(sfConfig::get('sf_app_config_dir').'/menu.yml');
  
    $this->menu = $menus['sorteos'];
  }
  
  public function executeLimpiarCache(sfWebRequest $request)
  {
    foreach($this->apps as $app)
    {
      $cache_dir = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.$app.DIRECTORY_SEPARATOR.$this->getContext()->getConfiguration()->getEnvironment().DIRECTORY_SEPARATOR.'template';
      $cache = new sfFileCache(array('cache_dir' => $cache_dir));
      $cache->clean();
    }
  
    $this->getUser()->setFlash('notice', 'Se limpió la \'vista cache\' de los interfaces de cliente.');
  
    $this->redirect('@homepage');
  }
  
  public function executeCambiarEstadoAplicacion(sfWebRequest $request)
  {
    $app = $request->getParameter('app', 'frontend');
    
    if($this->getContext()->getConfiguration()->isLockApp($app))
    {
      // Limpiamos todos los cachés (probablemente porque hemos actualizado la aplicación o el framework)
      if($request->hasParameter('clean'))
      {
        $cache = new sfFileCache(array('cache_dir' => sfConfig::get('sf_cache_dir')));
        $cache->clean();
      }
  
      // Activamos la aplicación
      $this->getContext()->getConfiguration()->enableApp($app);
      $this->getUser()->setFlash('notice', 'Se activó la interfaz del cliente.');
    }
    else
    {
      $this->getContext()->getConfiguration()->disableApp($app);
      $this->getUser()->setFlash('notice', 'Se desactivó la interfaz del cliente.');
    }
  
    $this->redirect('@homepage');
  }
}
