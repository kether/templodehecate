<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class tdhSeccion extends BasetdhSeccion
{
   
  public function __toString()
  {
    return $this->getNombre();
  }
  
  public function getNombre($parse = true)
  {
    return $parse ? htmlspecialchars($this->_get('nombre')) : $this->_get('nombre');
  }
  
  /**
   * @see tdhCriticaTable::retrieveBasicoBySeccionId()
   * @return ehForoHilo
   */
  public function getCriticaBasico()
  {
    return Doctrine::getTable('tdhCritica')->retrieveBasicoBySeccionId($this->getId());
  }
  
  /**
   * Comprueba si existe la imagen de la imagen de la sección o devuelve una por defecto.
   * 
   * @param string $tamano
   * @param boolean $dirRoute
   * @param boolean $nullWithoutExists
   */
  public function getImagen($tamano = 'defecto', $dirRoute = false, $nullWithoutExists = false)
  {
    $tam  = tdhConfig::getImageSectionSizes($tamano);
    $path = tdhConfig::get('img_section_path').'/'.$tam['prefijo'].$this->getSlug().'.jpg';
    
    if(file_exists(sfConfig::get('sf_web_dir').$path))
    {
      return ($dirRoute ? sfConfig::get('sf_web_dir') : '').$path;
    }
    elseif(!$nullWithoutExists)
    {
      return ($dirRoute ? sfConfig::get('sf_web_dir') : '').'/images/assets/'.$tam['prefijo'].'section.jpg';
    }
    else
    {
      return $dirRoute ? sfConfig::get('sf_web_dir').$path : null;
    }
  }
  
  public function getLogo($checkFileExist = true)
  {
    $path = tdhConfig::get('img_section_path').'/logo-'.$this->getSlug().'.png';
    return $checkFileExist ? (file_exists(sfConfig::get('sf_web_dir').'/'.$path) ? $path : null) : $path;
  }
  
  public function getFondo($checkFileExist = true)
  {
    $path = tdhConfig::get('img_section_path').'/fondo-'.$this->getSlug().'.jpg';
    return $checkFileExist ? (file_exists(sfConfig::get('sf_web_dir').'/'.$path) ? $path : null) : $path;
  }
  
  /**
   * DEPRECRATED. Comprueba si existe la imagen de la imagen de la sección o devuelve una por defecto.
   * 
   * @param $thumb Si es true devolverá la versión reducida a escala de la imagen de sección 
   * @return string
   */
  public function getImagenPath($thumb = false)
  {
    (string) $thumb = $thumb ? 'thumb-' : '';
    $path = tdhConfig::get('img_section_path').'/'.$thumb.$this->getSlug().'.jpg';
    
    return file_exists(sfConfig::get('sf_web_dir').$path) ? $path : '/images/assets/'.$thumb.'section.jpg';
  }
  
  /**
   * Comprueba si existe la imagen de la portada del producto de la sección o devuelve una portada por defecto.
   * 
   * @param boolean $thumb Si es true devolverá la versión reducida a escala de la portada 
   * @return string
   */
  public function getCoverPath($size = 'covmed', $default = true)
  {
    $path = tdhConfig::get('img_cover_path').'/'.$this->getSlug().'-'.$size.'.jpg';
    return !$default || file_exists(sfConfig::get('sf_web_dir').$path) ? $path : '/images/assets/cover-'.$size.'.jpg';
  }
  
  public function hasCover($size = 'covmed')
  {
    return file_exists(sfConfig::get('sf_web_dir').tdhConfig::get('img_cover_path').'/'.$this->getSlug().'-'.$size.'.jpg');
  }
  
  /**
   * Devuelve contenidos autorizados de la sección según el nombre de la tabla sin el prefijo.
   * 
   * @param string $tabla Nombre de la tabla sin el prefijo
   * @param integer $limite Límite de contenidos, por defecto 4
   * @param array $opciones
   */
  public function getContenidosPorTabla($tabla, $limite = 4, $opciones = array())
  {
    $opciones['seccion_slug'] = $this->getSlug();
    return Doctrine::getTable('tdh'.$tabla)->getAutorizados($limite, $opciones);
  }
  
  /**
   * Devuelve contenidos NO autorizados de la sección según el nombre de la tabla sin el prefijo.
   *
   * @param string $tabla Nombre de la tabla sin el prefijo
   * @param integer $limite Límite de contenidos, por defecto 4
   * @param array $opciones
   */
  public function getDesautorizadosPorTabla($tabla, $limite = 0, $opciones = array())
  {
    $opciones['seccion_slug'] = $this->getSlug();
    return Doctrine::getTable('tdh'.$tabla)->getDesautorizados($limite, $opciones);
  }
  
  /**
   * Cuenta el número 
   * 
   * @param string $tabla
   * @param array $opciones
   */
  public function countDesautorizadosPorTabla($tabla, $opciones = array())
  {
    $opciones['seccion_slug'] = $this->getSlug();
    return Doctrine::getTable('tdh'.$tabla)->countDesautorizados($opciones);
  }
  
  public function getEsMiFavorito($usuarioId = null)
  {
    if($usuario = $this->getFavoritaDeUsuarios()->getFirst())
    {
      return $usuario->getId() == $usuarioId;
    }
    else
    {
      return false;
    }
  }
  
  public function getRouting()
  {
    return '@tdh_seccion?seccion_slug='.$this->getSlug();
  }
  
  public function save(Doctrine_Connection $conn = null)
  {
    if(is_null($this->nombre_original))
    {
      $this->setNombreOriginal($this->getNombre());
    }
    
    parent::save($conn);
  }
}