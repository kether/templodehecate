<?php

/**
 * tdhSorteo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class tdhSorteo extends BasetdhSorteo
{
  protected $condicionesByServicio = array();
  
  public function __toString()
  {
    return $this->getNombre();
  }
  
  /**
   * Periodo abierto de inscripción.
   * 
   * @return boolean
   */
  public function periodoAbierto()
  {
    return ($this->getDesde() <= date('Y-m-d H:i:s')) && ($this->getHasta() > date('Y-m-d H:i:s')) && $this->getEstadoAbierto(); 
  }
  
  /**
   * Devuelve una colección de condiciones del sorteo por un servicio dado.
   * 
   * @param string $servicio Entre 'twitter' y 'facebook'
   * @return Doctrine_Collection
   */
  public function getCondicionesByServicio($servicio)
  {
    if(!isset($this->condicionesByServicio[$servicio]))
    {
      $this->condicionesByServicio[$servicio] = Doctrine::getTable('tdhSorteoCondicion')->retrieveListBySorteoIdAndServicio($this->getId(), $servicio);
    }
    
    return $this->condicionesByServicio[$servicio];
  }
  
  public function getImagePath($size = 'peq')
  {
    $attr = tdhConfig::getImageSorteoSizes($size);
    return tdhConfig::get('img_draw_path').'/'.(isset($attr['prefijo']) ? $attr['prefijo'] : '').$this->getSlug().'.jpg';
  }
  
  public function hasImage($size = 'peq')
  {
    return file_exists(sfConfig::get('sf_web_dir').$this->getImagePath($size));
  }
  
  public function getGanador()
  {
    return Doctrine::getTable('tdhSorteoParticipante')->retrieveGanadorBySemilla($this->getId(), $this->getSemilla());
  }
}