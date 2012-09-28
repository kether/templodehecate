<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class tdhRecurso extends BasetdhRecurso implements tdhContenido
{
  static $routing           = 'tdh_recurso';
  
  static $routing_seccion   = 'tdh_seccion_recurso';
  
  public function getMensaje()
  {
    return $this->getHilo()->getPrimerMensaje();
  }
  
  public function getTitular()
  {
    return $this->getMensaje()->getAsunto();
  }
  
  public function getRouting($enArray = false, $sfFormat = 'html', $genUrl = false)
  {
    if($enArray)
    {
      return $this->getSeccion()->getTipo()->getEsJuego() ?
        array('ruta' => self::$routing_seccion, 'parametros' => array('id' => $this->getId(), 'slug' => $this->getMensaje()->getSlug(), 'sf_format' => $sfFormat, 'seccion_slug' => $this->getSeccion()->getSlug())) :
        array('ruta' => self::$routing, 'parametros' => array('id' => $this->getId(), 'slug' => $this->getMensaje()->getSlug(), 'sf_format' => $sfFormat));
    }
    else
    {
      $ruta = $this->getSeccion()->getTipo()->getEsJuego() ?
        sprintf('@%s?id=%s&slug=%s&seccion_slug=%s&sf_format=%s', self::$routing_seccion, $this->getId(), $this->getMensaje()->getSlug(), $this->getSeccion()->getSlug(), $sfFormat) :
        sprintf('@%s?id=%s&slug=%s&sf_format=%s', self::$routing, $this->getId(), $this->getMensaje()->getSlug(), $sfFormat);
      
      if($genUrl)
      {
        return sfContext::getInstance()->getController()->genUrl($ruta, true);
      }
      else
      {
        return $ruta;
      }
    }
  }
  
  /**
   * Comprueba si el recurso tiene fichero PDF o puede convertir a PDF el HTML.
   * 
   * @param boolean $onlyFile Comprueba sólo la existencia del fichero.
   * @return boolean
   */
  public function hasPdf($onlyFile = false)
  {
    if(file_exists(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.tdhConfig::get('pdf_resource_path').DIRECTORY_SEPARATOR.$this->getHilo()->getPrimerMensaje()->getSlug().'.pdf'))
    {
      return true;
    }
    elseif($onlyFile)
    {
      return false;
    }
    else
    {
      // Activar cuando tengamos el conversor de PDF
      // return $this->getTieneHtml() && $this->getConverPdf();
      return false;
    }
  }
  
  public function getPdfPath($onlyFile = false)
  {
    if($onlyFile == true || file_exists(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.tdhConfig::get('pdf_resource_path').DIRECTORY_SEPARATOR.$this->getHilo()->getPrimerMensaje()->getSlug().'.pdf'))
    {
      return tdhConfig::get('pdf_resource_path').'/'.$this->getHilo()->getPrimerMensaje()->getSlug().'.pdf';
    }
    else
    {
      return $this->getRouting(false, 'pdf', true);
    }
  }
  
  /**
   * Comprueba si el recurso tiene fichero ePub o puede convertir a ePub el HTML.
   * 
   * @param boolean $onlyFile Comprueba sólo la existencia del fichero.
   * @return boolean
   */
  public function hasEPub($onlyFile = false)
  {
    if(file_exists(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.tdhConfig::get('epub_resource_path').DIRECTORY_SEPARATOR.$this->getHilo()->getPrimerMensaje()->getSlug().'.epub'))
    {
      return true;
    }
    elseif($onlyFile)
    {
      return false;
    }
    else
    {
      return $this->getTieneHtml() && $this->getConverEpub();
    }
  }
  
  public function getEPubPath($onlyFile = false)
  {
    if($onlyFile == true || file_exists(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.tdhConfig::get('epub_resource_path').DIRECTORY_SEPARATOR.$this->getHilo()->getPrimerMensaje()->getSlug().'.epub'))
    {
      return tdhConfig::get('epub_resource_path').'/'.$this->getHilo()->getPrimerMensaje()->getSlug().'.epub';
    }
    else
    {
      return $this->getRouting(false, 'epub', true);
    }
  }
  
  public function getUrlForApp($app)
  {
    return sfProjectConfiguration::getActive()->generaUrlFromApp($app, 'tdh_recurso', array(
      'id' => $this->getId(),'slug' => $this->getHilo()->getPrimerMensaje()->getSlug(), 'sf_format'=> 'html'
    ));
  }
  
  public function getRelacionados()
  {
    return Doctrine::getTable('tdhRecurso')
      ->autorizados()
      ->addWhere('c.id != ?', $this->getId())
      ->addOrderBy('m.visible_desde DESC, m.created_at DESC, c.id DESC')
      ->limit(5)
      ->execute();
  }
  
  /**
   * Comprueba si el usuario está autorizado a editar éste recurso
   * 
   * @param tdhSecurityUser $user
   * @return boolen
   */
  public function esAutorizadoParaEditar(tdhSecurityUser $user)
  {
    return $user->isAdministrador() || ($user->isAuthenticated() && $user->getUserId() == $this->getHilo()->getPrimerMensaje()->getUsuarioId()); 
  }
  
  public function getImagePath($tam = 'covmed', $defecto = false, $seccionDefecto = false)
  {
    $path = tdhConfig::get('img_cover_path').'/'.$this->getMensaje()->getSlug().'-'.$tam.'.jpg';
  
    if($defecto == false)
    {
      return $path;
    }
    else
    {
      /*
      $tamType = substr($tam, 0, 3);
      $tamSize = substr($tam, 3, 3);
      */
      return $this->hasImage($tam) ? $path : ($seccionDefecto ? $this->getSeccion()->getImagenPath($tam == 'secmed' ? true : false) : '/images/assets/cover-'.$tam.'.jpg');
    }
  }
  
  public function hasImage($tam = 'covmed')
  {
    return file_exists(sfConfig::get('sf_web_dir').$this->getImagePath($tam));
  }
  
  public function getEsMiFavorito($usuarioId = null)
  {
    if($usuario = $this->getFavoritoDeUsuarios()->getFirst())
    {
      return $usuario->getId() == $usuarioId;
    }
    else
    {
      return false;
    }
  }
  
  public function preSave($event)
  {
    // Grabamos la entradilla
    if(!$this->getEntradilla())
    {
      $this->setEntradilla(ehUtilesCadena::truncar(strip_tags($this->getMensaje()->getCuerpoHtml()), 150));
    }
  }
}