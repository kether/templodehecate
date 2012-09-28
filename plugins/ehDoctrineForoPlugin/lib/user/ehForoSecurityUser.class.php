<?php

class ehForoSecurityUser extends ehAuthSecurityUser
{
  const PERFIL_NICKNAME   = 'nickname';
  const PERFIL_AVATAR     = 'avatar';
  
  protected 
    $numMensajesNuevos = null,
    $templateVars = array();
  
  public function getNickname()
  {
    return $this->getUserAttribute(self::PERFIL_NICKNAME);
  }
  
  public function getAvatar()
  {
    return str_replace('50px-', '', $this->getUserAttribute(self::PERFIL_AVATAR));
  }
  
  public function getAvatarMini()
  {
    return $this->getUserAttribute(self::PERFIL_AVATAR);
  }
  
  public function getNumMensajesPrivadosNuevos()
  {
    $this->actualizaNumMensajesPrivadosNuevos();
    return $this->numMensajesNuevos;
  }
  
  /**
   * Entrega el registro de la tabla eh_foro_perfil
   * 
   * @return ehForoPerfil Un objeto ehForoPerfil o null
   */
  public function getPerfil()
  {    
    return $this->getAuthUser()->getPerfil();
  }
  
  /**
   * Devuelve true si el usuario tiene un perfil asociado a su cuenta ehUser
   * 
   * @return boolean
   */
  public function hasPerfil()
  {
    return !is_null($this->getPerfil());
  }
  
  public function setSrcAvatar($src)
  {
    $this->setUserAttribute(self::PERFIL_AVATAR, $src);
  }
  
  public function setNick($nick)
  {
    $this->setUserAttribute(self::PERFIL_NICKNAME, $nick);
  }
  
  public function logIn($user, $remember = false, Doctrine_Connection $conn = null)
  {
    parent::logIn($user, $remember, $conn);
    
    //$this->actualizaNumMensajesPrivadosNuevos();
    
    if(!$this->hasPerfil())
    {
      //Creamos el perfil del usuario permanentemente
      $perfil = new ehForoPerfil();
      $perfil->setehAuthUser($this->getAuthUser());
      $perfil->save();
      
      $this->getAuthUser()->setPerfil($perfil);
    }
    
    // Seteamos el nick, el avatar, la zona horaria y el idioma
    $this->setNick($this->getPerfil()->getNick() ? $this->getPerfil()->getNick() : $this->getUserName());
    $this->setSrcAvatar($this->getPerfil()->getAvatarMiniPath());
    $this->setUserAttribute('timezone', $this->getPerfil()->getZonaHoraria());
    $this->setCulture($this->getPerfil()->getIdioma());
  }
  
  public function actualizaNumMensajesPrivadosNuevos()
  {
    if(is_null($this->numMensajesNuevos))
      $this->numMensajesNuevos = Doctrine::getTable('ehForoMensajePrivado')->countNuevosPorUsuarioId($this->getUserId());
  }
  
  public function getPagerPrivadosRecibidos($pagina = 1, $opciones = array())
  {
    $pager = new sfDoctrinePager('ehForoMensajePrivado', ehForoConfig::getStatic('temas_por_pagina'));
    $pager->setParameter('linksPorPagina', ehForoConfig::getStatic('links_temas_por_pagina'));
    $pager->setPage($pagina);
    $pager->setTableMethod('autorizadosRecibidos');
    
    $pager->getQuery()
      ->addWhere('mp.usuario_destino_id = ?', $this->getUserId())
      ->orderBy('mp.estado_leido ASC')
      ->orderBy('m.created_at DESC');
    
    $pager->init();
    
    return $pager;
  }
  
  public function getPagerPrivadosEnviados($pagina = 1, $opciones = array())
  {
    $pager = new sfDoctrinePager('ehForoMensajePrivado', ehForoConfig::getStatic('temas_por_pagina'));
    $pager->setParameter('linksPorPagina', ehForoConfig::getStatic('links_temas_por_pagina'));
    $pager->setPage($pagina);
    $pager->setTableMethod('autorizadosEnviados');
    
    $pager->getQuery()
      ->addWhere('m.usuario_id = ?', $this->getUserId())
      ->addOrderBy('mp.estado_leido ASC, m.created_at DESC');
    
    $pager->init();
    
    return $pager;
  }
  
  /**
   * Comprueba si es administrador el usuario autentificado.
   * 
   * @return boolean
   */
  public function isAdministrador()
  {
    return $this->hasCredential(array('superadministrator', 'superadministrador', 'administrator', 'administrador', 'admin'), false);
  }
  
  public function setTemplateVar($name, $value)
  {
    $this->templateVars[$name] = $value;
  }
  
  public function getTemplateVar($name)
  {
    return $this->templateVars[$name];
  }
}