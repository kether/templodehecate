<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class tdhCritica extends BasetdhCritica implements tdhContenido
{  
  static $routing           = 'tdh_critica';
  
  static $routing_seccion   = 'tdh_seccion_critica';
  
  public function calcularNotas()
  {
    $result = Doctrine::getTable('tdhCriticaNota')->createQuery()
        ->select('COUNT(id) AS num_notas, AVG(nota) AS nota_media')
        ->where('critica_id = ?', $this->getId())->fetchOne();
    
    $this
      ->setNotaMedia($result->getNotaMedia())
      ->setVotos($result->getNumNotas())
      ->save();
  }
  
  public function getMensaje()
  {
    return $this->getHilo()->getPrimerMensaje();
  }
  
  public function getTitular()
  {
    return $this->getMensaje()->getAsunto();
  }
  
  /**
   * @see tdhCritica::getTitular()
   */
  public function getEntradilla()
  {
    return $this->getMensaje()->getAsunto();
  }
  
  public function getNbCapturas()
  {
    return Doctrine::getTable('tdhCriticaCaptura')
      ->createQuery()
      ->where('critica_id = ?', $this->getId())
      ->count();
  }
  
  public function getCapturasPorTamanno($size = 'p')
  {
    /**
     * @var Doctrine_Query
     */
    $q = Doctrine::getTable('tdhCriticaCaptura')
      ->createQuery()
      ->where('critica_id = '.$this->getId());

    switch($size)
    {
      case 'm':
        $q->addWhere('tam_med = ?', true);
        break;
      case 'l':
      case 'g':
        $q->addWhere('tam_gra = ?', true);
        break;
      default:
        $q->addWhere('tam_peq = ?', true);
        break;
    }
    
    return $q->execute();
  }
  
  /**
   * @see tdhCritica::getCoverPath()
   */
  public function getImagePath($size = 'covmed', $default = true)
  {
    $size = strpos($size, 'cov') === false ? 'cov'.$size : $size;
    return $this->getCoverPath($size, $default);
  }
  
  /**
   * @see tdhCritica::hasCover()
   */
  public function hasImage($size)
  {
    return $this->hasCover($size);
  }
  
  /**
   * Comprueba si existe la imagen de la portada del producto de la crítica o devuelve una portada por defecto.
   * 
   * @param string $size Tamaño de la cubierta del producto 
   * @return string
   */
  public function getCoverPath($size = 'covmed', $default = true)
  {
    $path = tdhConfig::get('img_cover_path').'/'.$this->getMensaje()->getSlug().'-'.$size.'.jpg';
    return !$default || file_exists(sfConfig::get('sf_web_dir').$path) ? $path : '/images/assets/cover-'.$size.'.jpg';
  }
  
  /**
   * Comprueba si existe la cubierta del producto en el asset
   * 
   * @param string $size Tamaño de la cubierta del producto
   */
  public function hasCover($size = 'covmed')
  {
    return file_exists(sfConfig::get('sf_web_dir').tdhConfig::get('img_cover_path').'/'.$this->getMensaje()->getSlug().'-'.$size.'.jpg');
  }
  
  public function getRouting($enArray = false, $sfFormat = 'html', $genUrl = false)
  {
    if($enArray)
    {
      return $this->getSeccion()->getTipo()->getEsJuego() ?
        array('ruta' => self::$routing_seccion, 'parametros' => array('id' => $this->getId(), 'slug' => $this->getMensaje()->getSlug(), 'seccion_slug' => $this->getSeccion()->getSlug())) :
        array('ruta' => self::$routing, 'parametros' => array('id' => $this->getId(), 'slug' => $this->getMensaje()->getSlug()));
    }
    else
    {
      $ruta = $this->getSeccion()->getTipo()->getEsJuego() ?
        sprintf('@%s?id=%s&slug=%s&seccion_slug=%s', self::$routing_seccion, $this->getId(), $this->getMensaje()->getSlug(), $this->getSeccion()->getSlug()) :
        sprintf('@%s?id=%s&slug=%s', self::$routing, $this->getId(), $this->getMensaje()->getSlug());
      
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
  
  public function getUrlForApp($app)
  {
    return sfProjectConfiguration::getActive()->generaUrlFromApp($app, self::$routing, array(
      'id' => $this->getId(),'slug' => $this->getHilo()->getPrimerMensaje()->getSlug(), 'sf_format'=> 'html'
    ));
  }
  
  public function getRelacionados()
  {
    return Doctrine::getTable('tdhCritica')
      ->autorizados()
      ->addWhere('c.id != ?', $this->getId())
      ->orderBy('m.visible_desde DESC')->orderBy('m.created_at DESC')->orderBy('c.id DESC')
      ->limit(5)
      ->execute();
  }
  
  public function ponerCapturasEnCuerpo()
  {
    $capturas = $this->getCapturasPorTamanno('m');
    
    if($capturas->count() > 0)
    {
      $cuerpo = new ehUtilesCadenaRica($this->getMensaje()->getCuerpo());
      $cuerpo->setBBcode($this->getMensaje()->bbcode)
        ->setHTML($this->getMensaje()->html)
        ->setMarkdown($this->getMensaje()->markdown)
        ->setEmoticonos($this->getMensaje()->emoticonos)
        ->setNL2BR($this->getMensaje()->nl2br);
      
      $cuerpo = $cuerpo->getCadenaParseada();
      $offset = 0;
      
      foreach($capturas as $captura)
      {
        // Buscamos el tercer párrafo
        for($i = 0; $i < 3 && $offset !== false; $i++)
        {
          $offset = strpos($cuerpo, '</p>', $offset+4);
        }
        
        if($offset === false)
        {
          break;
        }
        else
        {          
          $cadena = '<div id="tdh_captura_'.$captura->getId().'" class="tdh_captura"><img src="'.$captura->getPath('m').'" alt="Captura" /><div class="tdh_captura_comentario">'.$captura->getComentario().'</div></div>';
          
          $cuerpo = ehUtilesCadena::insertarCadena($cadena, $cuerpo, $offset);
          $offset = $offset + 4 + strlen($cadena);
        }
      }
      
      // Lo guardamos. Tenemos que hacerlo así porque con el propio objeto ignoraría el contenido de cuerpoHtml al hacer save()
      Doctrine_Query::create()->update('ehForoMensaje')->where('id = ?', $this->getMensaje()->getId())->set('cuerpo_html', '?', $cuerpo)->execute();
    }
  }
  
  public function getVotoUsuario(tdhSecurityUser $user)
  {
    if(!$user->isAuthenticated()) return null;
    
    return Doctrine::getTable('tdhCriticaNota')->findOneByCriticaIdAndUsuarioId($this->getId(), $user->getUserId());
  }
  
  public function preSave($event)
  {
    if($this->getNota() > 0)
    {
      $this->setEstadoSinNota(false);
    }
  }
  
  public function postSave($event)
  {
    if($this->getCapturasAutomaticas())
    {
      $this->ponerCapturasEnCuerpo();
    }
  }
}