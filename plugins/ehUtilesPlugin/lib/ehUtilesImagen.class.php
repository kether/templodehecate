<?php

/*
 * Proyecto ehUtilesPlugin
 * (c) 2008 Pablo Floriano <p.floriano@estudiohecate.com>
 */

require_once 'vendor/phpthumb/ThumbLib.inc.php';

/**
 * Esta clase permite integrar en symfony y en castellano una librería para redimensionar imágenes.
 * La librería usada es PHP Thumb (http://phpthumb.gxdlabs.com/)
 * 
 * @package     ehUtilesPlugin
 * @subpackage  ehUtilesImagen
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 * @version     v2.0
 */
class ehUtilesImagen
{
  // Modos de ajuste de redimensión de la captura
  const AJUSTE_MEJOR        = 'mejor';
  const AJUSTE_ALTO         = 'alto';
  const AJUSTE_ANCHO        = 'ancho';
  const AJUSTE_EXACTO       = 'exacto';
  const AJUSTE_ADAPTATIVO   = 'adaptativo';
  
  // Formato de los ficheros de imagen
  const FORMATO_JPEG  = 'jpeg';
  const FORMATO_JPG   = 'jpg';
  const FORMATO_GIF   = 'gif';
  const FORMATO_PNG   = 'png';
  
  protected $ficheroOrigen;
  protected $ficheroDestino;
  protected $modoRedimensionar = 'adaptativo';
  protected $formatoSalida = 'jpg';
  
  protected $ancho  = 0;
  protected $alto   = 0;
  
	protected $imgObjeto = null;
	
	public function __construct($ficheroOrigen)
	{
    $this->ficheroOrigen = $ficheroOrigen;
		
    try
    {
    	/**
    	 * @var GdThumb
    	 */
      $this->imgObjeto = PhpThumbFactory::create($this->ficheroOrigen);
      
      $dimensiones = $this->getImagen()->getCurrentDimensions();
      
      $this->ancho = $dimensiones['width'];
      $this->alto  = $dimensiones['height'];
    }
    catch(Exception $e)
    {
    	throw new Exception('No se pudo leer la imagen.');
    }
	}
	
	public function getImagen()
	{
    return $this->imgObjeto;
	}
	
	public function getAnchura()
	{
	  return (string)$this->ancho;
	}
	
	public function getAltura()
	{
	  return (string)$this->alto;
	}
	
	public function getFicheroDestino()
	{
	  return $this->ficheroDestino;
	}
	
  public function getFicheroOrigen()
  {
    return $this->ficheroOrigen;
  }
	
  public function getModoRedimension()
  {
    return $this->modoRedimensionar;
  }
  
	public function setFicheroDestino($fichero)
	{
	  $this->ficheroDestino = $fichero;
	  return $this;
	}
	
	public function setMaxAncho($nPixels)
	{
		$this->ancho = $nPixels;
		return $this;
	}
	
	public function setMaxAlto($nPixels)
	{
    $this->alto = $nPixels;
    return $this;
	}
  
	/**
   * Especifica el modo de redimensión de la imagen. Modos permitidos:
   *  * ehUtilesImagen::AJUSTE_MEJOR o 'mejor': Ajusta al ancho o alto, lo que sea menor
   *  * ehUtilesImagen::AJUSTE_ALTO o 'alto': Ajusta al alto (y), ignorando el ancho (x)
   *  * ehUtilesImagen::AJUSTE_ANCHO o 'ancho': Ajusta al ancho (x), ignorando el alto (y)
   *  * ehUtilesImagen::AJUSTE_ADAPTATIVO o 'adaptativo': Ajusta y recorta de forma adaptativa
   * 
   * @param string $sModo Una cadena con el modo de redimensión
   * @return ehUtilesImagen Devuelve el objeto actualizado
   */
	public function setModoRedimension($sModo)
	{
	  $this->modoRedimensionar = $sModo;
	  return $this;
	}
	  
	public function setFormatoSalida($sFormato)
  {
    $this->formatoSalida = $sFormato == 'jpeg' ? 'jpg' : $sFormato;
    return $this;
  }
  
  /**
   * Procesamos la imagen redimensionándola según el modo asignado
   * 
   * @return ehUtilesImagen La instancia del objeto modificado
   */
  public function redimensionar()
  {
    switch($this->getModoRedimension())
    {
      case self::AJUSTE_MEJOR:
      case self::AJUSTE_ALTO:
      case self::AJUSTE_ANCHO:
        $this->getImagen()->resize($this->getAnchura(), $this->getAltura());
        break;
      case self::AJUSTE_EXACTO:
      case self::AJUSTE_ADAPTATIVO:
        $this->getImagen()->adaptiveResize($this->getAnchura(), $this->getAltura());
        break;
    }
    
    return $this;
  }
  
  /**
   * Redimensionamos la imagen y la guardamos en el 'directorio/fichero.ext' destino
   * 
   * @see ehUtilesImagen::save()
   */
  public function redimensionarAndGuardar()
  {
  	return $this->save();
  }
  
  /**
   * Redimensionamos la imagen y la guardamos en el 'directorio/fichero.ext' destino
   * 
   * @return boolean Devuelve verdadero si se redimensionó y guardó con éxito la imagen
   */
  public function save()
  {
    try
    {
      $this->redimensionar();
      $this->getImagen()->save($this->getFicheroDestino(), $this->formatoSalida);
      
      $dimensiones = $this->getImagen()->getCurrentDimensions();
      
      $this->ancho = $dimensiones['width'];
      $this->alto  = $dimensiones['height'];
      
      return true;
    }
    catch(Exception $e)
    {
      return false;
    }
  }
}