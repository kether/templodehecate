<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class tdhNoticia extends BasetdhNoticia implements tdhContenido
{  
  static $routing           = 'tdh_noticia';
  
  static $routing_seccion   = 'tdh_seccion_noticia';
  
  public function getRouting($enArray = false, $sfFormat = 'html', $genUrl = false)
  {
    if($this->esSoloNoticia())
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
    else
    {
      if(isset($this->getHilo()->Recurso))
      {
        return '@tdh_recurso?id='.$this->getHilo()->getRecurso()->getId().'&slug='.$this->getMensaje()->getSlug();
      }
      elseif(isset($this->getHilo()->Critica))
      {
        return '@tdh_critica?id='.$this->getHilo()->getCritica()->getId().'&slug='.$this->getMensaje()->getSlug();
      }
      elseif(isset($this->getHilo()->Evento))
      {
        return '@tdh_evento?id='.$this->getHilo()->getEvento()->getId().'&slug='.$this->getMensaje()->getSlug();
      }
      else
      {
        return '@eh_foro_tema?pagina=1&id='.$this->getHiloId();
      }
    }
  }
  
  public function getUrlForApp($app)
  {
    return sfProjectConfiguration::getActive()->generaUrlFromApp($app, 'tdh_noticia', array(
      'id' => $this->getId(), 'slug' => $this->getHilo()->getPrimerMensaje()->getSlug(), 'sf_format' => 'html'
    ));
  } 
  
  /**
   * Devuelve el primer mensaje asociado al hilo del contenido
   * 
   * @return ehForoMensaje
   */
  public function getMensaje()
  {
    return $this->getHilo()->getPrimerMensaje();
  }
  
  /**
   * Devuelve el asunto del primer mensaje del hilo asociado al contenido que corresponde con el titular.
   * 
   * @return string La cadena del titular del contenido
   */
  public function getTitular()
  {
    return $this->getMensaje()->getAsunto();
  }
  
  public function getImagePath($tam = 'peq', $defecto = true)
  {
    $path = tdhConfig::get('img_news_path').'/'.$this->getMensaje()->getSlug().'-'.$tam.'.jpg';
      
    if($defecto == false)
    {
      return $path;
    }
    else
    {
      return $this->hasImage($tam) ? $path : $this->getSeccion()->getImagenPath($tam == 'peq' ? true : false);
    }
  }
  
  public function hasImage($tam = 'med')
  {
    return file_exists(sfConfig::get('sf_web_dir').tdhConfig::get('img_news_path').'/'.$this->getMensaje()->getSlug().'-'.$tam.'.jpg');
  }
  
  public function getRelacionados()
  {
    return Doctrine::getTable('tdhNoticia')
      ->autorizados()
      ->addWhere('c.id != ?', $this->getId())
      ->orderBy('m.visible_desde DESC')->orderBy('m.created_at DESC')->orderBy('c.id DESC')
      ->limit(5)
      ->execute();
  }
  
  /**
   * Devuelve true si el registro es simplemente una noticia o en realidad es un recurso, crítica o evento
   * 
   * @return boolean True o false
   */
  public function esSoloNoticia()
  {
    return !(isset($this->getHilo()->Recurso) || isset($this->getHilo()->Critica) || isset($this->getHilo()->Evento));
  }
  
  public function preSave($event)
  {
    if(!$this->getEntradilla())
    {
      $this->setEntradilla(ehUtilesCadena::truncar(strip_tags($this->getMensaje()->getCuerpoHtml()), 150));
    }
    
    // Si no hemos encontrado una fuente pero si su URL usamos su dominio para ponerle nombre a la fuente
    if($this->getUrlFuente() && !$this->getNombreFuente())
    {
      preg_match("/^(http:\/\/)?([^\/]+)/i", $this->getUrlFuente(), $matches);
      $host = $matches[2];
      preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
      
      $this->setNombreFuente($matches[0]);
    }
  }
}