<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginehForoPerfil extends BaseehForoPerfil
{
  protected $estadoActivo = null;
  
  public function getNickArreglado()
  {
    return $this->getNick() ? $this->getNick() : $this->getUsuario()->getUsername();
  }
  
  public function getAvatarPath()
  {
    return $this->getUriAvatar() ? $this->getUriAvatar() : ehForoConfig::getStatic('path_avatar_default');
  }
  
  public function getAvatarMiniPath()
  {
    if($this->getUriAvatar())
    {
      $info = pathinfo($this->getUriAvatar());
      return $info['dirname'].'/'.ehForoConfig::getStatic('avatar_size_mini').'px-'.$info['basename'];
    }
    else
    {
      return ehForoConfig::getStatic('path_avatar_default');
    }
  }
  
  /**
   * Chequea si el usuario se encuentra activo (navegando) por la aplicación.
   * 
   * @return boolean Devuelve verdadero o falso
   */
  public function comprobarEstadoUsuarioActivo()
  {
    if(is_null($this->estadoActivo))
    {
      $this->estadoActivo = Doctrine::getTable('ehForoUsuarioActivo')->findOneByUsuarioId($this->getUsuarioId()) ? true :false;
    }
    
    return $this->estadoActivo;
  }
}