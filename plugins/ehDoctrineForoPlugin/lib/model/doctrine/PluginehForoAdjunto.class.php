<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginehForoAdjunto extends BaseehForoAdjunto
{
  public function __toString()
  {
    return $this->getNombreArreglado();
  }
  
  public function getFichero()
  {
    return $this->getDirUpload().'/'.$this->getNombreFichero();
  }
  
  public function getNombreArreglado()
  {
    return $this->getNombre() ? $this->getNombre() : $this->getNombreFichero();
  }
  
  public function getDirUpload()
  {    
    return sfConfig::get('sf_upload_dir').'/'.$this->getTipo()->getDir();
  }
  
  public function getFicheroSize()
  {
    return filesize($this->getFichero());
  }
  
  public function getRouting()
  {
    $fileinfo = pathinfo($this->getNombreFichero());
    return '@eh_foro_link_adjunto?nombre_adjunto='.$fileinfo['filename'].'&sf_format='.$fileinfo['extension'].'&adjunto_id='.$this->getId();
  }
  
  /**
   * Aumenta el contador de descargas en 1. 
   */
  public function addDescarga()
  {
    $this->setNumeroDescargas($this->getNumeroDescargas()+1);
    parent::save();
  }
  
  public function save(Doctrine_Connection $conn = null)
  {
    parent::save($conn);
    
    $mensaje = Doctrine::getTable('ehForoMensaje')->findOneById($this->getMensajeId());
    $mensaje->setTieneAdjuntos(true);
    $mensaje->save($conn);
  }
}