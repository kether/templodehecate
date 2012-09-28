<?php

/*
 * Proyecto ehUtilesPlugin
 * (c) 2009 Pablo Floriano <p.floriano@estudiohecate.com>
 */

/**
 * Permite parsear el contenido de una cadena de texto en markdown o bbcode a etiquetas HTML equivalentes. También añade
 * retornos de carro, elimina tags HTML y cambia los símbolos de emoticonos por tags "img" equivalentes.
 * 
 * @package     ehUtilesPlugin
 * @author      Pablo Floriano 
 */
class ehUtilesCadenaRica
{
  protected
    $sCadenaOriginal = '',
    $sCadenaParseada = '';
  
  protected
    $bMarkdown = false,         # Transformamos las marcas de markdown a HTML
    $bMarkdownExtra = false,    # Transformamos las marcas de markdown extra a HTML (sí está activa esta, se desactiva $bMarkdownExtra
    $bHTML = true,              # Si es false, quitamos todo el HTML antes de pasar las otras opciones de la cadena original
    $nl2br = false,             # No compatible con markdown o markdown_extra
    $bBBcode = false,
    $bEmoticonos = false;
  
  protected
    $flagCambiado = false,
    $flagForzarMarkdownExtra = true;
    
  public function __construct($sCadena)
  {
    $this->sCadenaOriginal = $sCadena;
    $this->sCadenaParseada = $sCadena;
  }
  
  public function __toString()
  {
    return $this->getCadenaParseada();
  }
  
  public function getCadenaOriginal()
  {
    return $this->sCadenaOriginal;
  }
  
  /**
   * Setea los modos de parser del objeto mediante una serie de registros clave->valor pasados en un array
   * 
   * @param array $parsers Una matriz clave->boolean con los parámetros de configuración para el parser. 
   * @return ehUtilesCadenaRica
   */
  public function setParsersByArray($parsers)
  {
    if(is_array($parsers))
    {
      foreach($parsers as $clave => $valor)
      {
        switch(strtolower($clave))
        {
          case 'markdown':
            $this->setMarkdown($valor);
            break;
          case 'bbcode':
            $this->setBBcode($valor);
            break;
          case 'markdown_extra':
          case 'markdownextra':
            $this->setMarkdownExtra($valor);
            break;
          case 'nl2br':
            $this->setNL2BR($valor);
            break;
          case 'html':
            $this->setHTML($valor);
            break;
          case 'emoticonos':
          case 'emoticons':
            $this->setEmoticonos($valor);
            break;
        }
      }
    }
  }
  
  /**
   * Setea la configuración del parseador con el Markdown activado o desactivado
   * 
   * @param boolean $bool Verdadero o falso
   * @return ehUtilesCadenaRica El objeto modificado
   */
  public function setMarkdown($bool)
  {
    if($bool != $this->bMarkdown)
    {
      $this->bMarkdown = $bool;
      $this->flagCambiado = true;
    }
    
    return $this;
  }
  
  /**
   * Setea la configuración del parseador con el Markdown Extra activado o desactivado
   * 
   * @param boolean $bool Verdadero o falso
   * @return ehUtilesCadenaRica El objeto modificado
   */
  public function setMarkdownExtra($bool)
  {
    if($bool != $this->bMarkdownExtra)
    {
      $this->bMarkdownExtra = $bool;
      $this->flagCambiado = true;
    }
    
    return $this;
  }
  
  /**
   * Setea la configuración del parseador con el HTML activado o desactivado
   * 
   * @param boolean $bool Verdadero o falso
   * @return ehUtilesCadenaRica El objeto modificado
   */
  public function setHTML($bool)
  {
    if($bool != $this->bHTML)
    {
      $this->bHTML = $bool;
      $this->flagCambiado = true;
    }
    
    return $this;
  }
  
  public function setNL2BR($bool)
  {
    if($bool != $this->nl2br )
    {
      $this->nl2br = $bool;
      $this->flagCambiado = true;
    }
    
    return $this;
  }
  
  /**
   * Setea la configuración del parseador con el BBCode activado o desactivado
   * 
   * @param boolean $bool Verdadero o falso
   * @return ehUtilesCadenaRica El objeto modificado
   */
  public function setBBcode($bool)
  {
    if($bool != $this->bBBcode )
    {
      $this->bBBcode = $bool;
      $this->flagCambiado = true;
    }
    return $this;
  }
  
  public function setEmoticonos($bool)
  {
    if($bool != $this->bEmoticonos )
    {
      $this->bEmoticonos = $bool;
      $this->flagCambiado = true;
    }
    return $this;
  }
  
  protected function parsea()
  {
    $this->sCadenaParseada = $this->sCadenaOriginal;
    
    if(!$this->bHTML)
    {
      $this->sCadenaParseada = strip_tags($this->sCadenaParseada);
    }
    
    if($this->bBBcode)
    {
      $this->sCadenaParseada = ehUtilesCadena::formatearTextoBBCodeAHTML($this->sCadenaParseada, $this->bEmoticonos);
    }
    elseif($this->bMarkdown && !$this->bMarkdownExtra && !$this->flagForzarMarkdownExtra)
    {      
      $this->sCadenaParseada = ehUtilesCadena::formatearTextoMarkdownAHTML($this->sCadenaParseada);
    }
    elseif($this->bMarkdownExtra || ($this->bMarkdown && $this->flagForzarMarkdownExtra))
    {
      $this->sCadenaParseada = ehUtilesCadena::formatearTextoMarkdownExtraAHTML($this->sCadenaParseada);
    }
    elseif($this->nl2br)
    {
      $this->sCadenaParseada = nl2br($this->sCadenaParseada);
    }
  }
  
  public function getCadenaParseada()
  {
    if($this->flagCambiado == true)
    {
      $this->parsea();
      $this->flagCambiado = false;
    }
    
    return $this->sCadenaParseada;
  }
}