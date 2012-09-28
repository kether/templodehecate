<?php

/**
 * ehForoConectados tiene métodos para acceder a los usuarios conectados y calcular el número de usuarios registrados e invitados.
 * 
 * @package ehForoPlugin
 * @author Pablo Floriano 
 */
class ehForoConectados
{
  protected
    $usuarios             = null,
    $usuariosRegistrados  = null;
  
  protected
    $nbRegistrados        = null,
    $nbInvitados          = null;
  
  public function getUsuarios()
  {
    if(is_null($this->usuarios))
    {
      $this->usuarios = Doctrine::getTable('ehForoUsuarioActivo')->getEnOrden();
    }
    
    return $this->usuarios;
  }
  
  /**
   * Calcula y devuelve una lista de los usuarios conectados que además estén autenticados en el sitio.
   * 
   * @return array Lista de usuarios autenticados.
   */
  public function getUsuariosRegistrados()
  {
    if(is_null($this->usuariosRegistrados))
    {
      $this->usuariosRegistrados = array();
      foreach($this->getUsuarios() as $usuario)
      {
        if(!is_null($usuario->getUsuarioId()))
        {
          $this->usuariosRegistrados[] = $usuario;
        }
      }
    }
    
    return $this->usuariosRegistrados;
  }
  
  /**
   * Número de usuarios conectados autenticados.
   * 
   * @return integer
   */
  public function getNumRegistrados()
  {
    if($this->nbRegistrados === null)
    {
      $this->calculaConectados();
    }
    
    return $this->nbRegistrados;
  }
  
  /**
   * Número de usuarios conectados no-autenticados.
   * 
   * @return integer
   */
  public function getNumInvitados()
  {
    if($this->nbInvitados === null)
    {
      $this->calculaConectados();
    }
    
    return $this->nbInvitados;
  }
  
  /**
   * Número total de usuarios conectados.
   * 
   * @return integer
   */
  public function getNumConectados()
  {
    return $this->getNumRegistrados() + $this->getNumInvitados();
  }
  
  /**
   * Rango de tiempo en minutos (redondeando hacia abajo) que el sistema reconoce como usuarios conectados.
   * 
   * @return integer Minutos.
   */
  public function getMinutosTimeout()
  {
    return floor(ehForoConfig::getStatic('usuario_activo_timeout') / 60);
  }
  
  protected function calculaConectados()
  {
    $this->nbRegistrados  = 0;
    $this->nbInvitados    = 0;
    
    foreach($this->getUsuarios() as $usuario)
    {
      if($usuario->getUsuarioId())
      {
        $this->nbRegistrados++;
      }
      else
      {
        $this->nbInvitados++;
      }
    } 
  }
}