<?php
class tdhSecurityUser extends ehForoSecurityUser
{
  public function logIn($user, $remember = false, Doctrine_Connection $conn = null)
  {
    parent::logIn($user, $remember, $conn);
    
    $this->setearSinPublicidad();
  }
  
  public function tieneRedireccionCanonica()
  {
    return !$this->isAuthenticated() || ($this->isAuthenticated() && $this->getAuthUser()->getPerfil()->getForoATemplo());
  }
  
  /**
   * Comprueba si el usuario puede visitar la web sin publicidad, y en caso afirmativo se añade un atributo para que el sitio lo
   * identifique en los espacios con publicidad.
   */
  public function setearSinPublicidad()
  {
    if($this->isAuthenticated())
    {
      $this->setUserAttribute('sin_publicidad', ($this->getAuthUser()->getPerfil()->getSinPubli() || ($this->getAuthUser()->getPerfil()->getSinPubliHasta() > date('Y-m-d H:i:s'))));
    }
  }
  
  /**
   * @return boolean Verdadero si el usuario no tiene que ver la publicidad
   */
  public function sinPublicidad()
  {
    return $this->getUserAttribute('sin_publicidad', false);
  }
  
  /** 
   * Comprueba si es colaborador de la sección en la que está o de alguna sección
   * 
   * @param null|string $seccion Identificador de la sección en la que está
   * @return boolean
   */
  public function esColaborador($seccion = '')
  {
    return $this->hasCredential(array('colaborador', $seccion), false) || $this->isAdministrador();
  }
}