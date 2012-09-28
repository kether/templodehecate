<?php

class tdhPaginadorContenido {
  
  protected $cuerpoHtml;
  
  protected $conincidenciasDelDivisor = null;
  
  protected $divisor = '</p>';
  
  protected $paginas = null;
  
  protected $paginaActual = 1;
  
  protected $cuerpoEnDivisiones = array();
  
  protected $parrafosPorPagina = 8;
  
  public function __construct($cuerpoHtml)
  {
    $this->cuerpoHtml = $cuerpoHtml;
  }
  
  public function hayQuePaginar()
  {
    return $this->getPaginas() > 1 ? true : false;
  }
  
  public function getCoincidenciasDivisor()
  {
    if(is_null($this->conincidenciasDelDivisor))
    {
      $this->conincidenciasDelDivisor = substr_count($this->cuerpoHtml, $this->divisor);
    }
    
    return $this->conincidenciasDelDivisor;
  }
  
  public function getPaginas()
  {
    if(is_null($this->paginas))
    {
      $this->paginas = ceil($this->getCoincidenciasDivisor() / $this->parrafosPorPagina);
      $this->paginas = $this->paginas < 1 ? 1 : $this->paginas;
    }

    return $this->paginas;
  }
  
  public function getPagina()
  {
    return $this->paginaActual;
  }
  
  public function setPagina($pagina)
  {
    $this->paginaActual = $pagina;
    return $this;
  }
  
  public function getCuerpoHtmlActual()
  {
    return $this->getCuerpoPorPagina($this->getPagina());
  }
  
  public function getCuerpoPorPagina($pagina = 1)
  {
    if(!isset($this->cuerpoEnDivisiones[$pagina]))
    {
      if($this->getPaginas() < 2)
      {
        $this->cuerpoEnDivisiones[$pagina] = $this->cuerpoHtml;
      }
      else
      {        
        $parrafos = explode($this->divisor, $this->cuerpoHtml);
      
        foreach($parrafos as $num => $parrafo)
        {
          $paginaActual = ceil($num/$this->parrafosPorPagina) > 0 ? ceil($num/$this->parrafosPorPagina) : 1;
          
          if(isset($this->cuerpoEnDivisiones[$paginaActual]))
          {
            $this->cuerpoEnDivisiones[$paginaActual] .= $parrafo.$this->divisor;
          }
          else
          {
            $this->cuerpoEnDivisiones[$paginaActual]  = $parrafo.$this->divisor;
          }
        }
      }
    }
    
    return $this->cuerpoEnDivisiones[$pagina];
  }
}