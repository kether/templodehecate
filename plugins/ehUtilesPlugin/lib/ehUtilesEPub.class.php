<?php

class ehUtilesEPub 
{
  /**
   * @var EPub
   */
  protected $libro;
  
  protected $cabeceraXhtml = "";
  
  protected $pieXhtml = "";
  
  public function __construct()
  {
    $this->libro = new EPub();
    
    $this->libro->setLanguage(sfConfig::get('sf_default_culture'));
    $this->libro->setPublisher('Estudio Hécate', 'http://www.estudiohecate.com');
    
    $this->cabeceraXhtml = <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
EOF;
    
    $this->pieXhtml = "</body>\n</html>\n";
  }
  
  /**
   * @return EPub
   */
  public function getLibro()
  {
    return $this->libro;
  }
  
  public function setTitulo($valor)
  {
    $this->getLibro()->setTitle($valor);
    return $this;
  }
  
  public function setEtiquetas($valor)
  {
    $this->getLibro()->setSubject($valor);
    return $this;
  }
  
  /**
   * Pone nombre y URL al editor/publicador del libro
   * 
   * @param string $nombre
   * @param string $url
   */
  public function setEditor($nombre, $url)
  {
    $this->getLibro()->setPublisher($nombre, $url);
    return $this;
  }
  
  public function setDescripcion($valor)
  {
    $this->getLibro()->setDescription($valor);
    return $this;
  }
  
  /**
   * El nombre del autor.
   * 
   * @param string $nombre Nombre completo del autor
   * @param string|null $nombreBusqueda Nombre en el orden preferido de búsqueda del autor (p.e.: primero los apellidos)
   */
  public function setAutor($nombre, $nombreBusqueda = null)
  {
    $this->getLibro()->setAuthor($nombre, $nombreBusqueda ? $nombreBusqueda : $nombre);
    return $this;
  }
  
  /**
   * Dirección de la portada del ePub.
   * 
   * @param string $valor Dirección 'path' dónde se encuentra la portada del ePub
   */
  public function setPortada($valor)
  {
    $this->getLibro()->setCoverImage($valor);
    return $this;
  }
  
  /**
   * Dirección URL de la fuente del ePub
   * 
   * @param string $valor
   */
  public function setUrl($valor)
  {
    $this->getLibro()->setSourceURL($valor);
    
    if(!$this->getLibro()->getIdentifier())
    {
      $this->getLibro()->setIdentifier($valor, EPub::IDENTIFIER_URI);
    }
    
    return $this;
  }
  
  public function setFecha($valor)
  {
    $this->getLibro()->setDate(strtotime($valor));
    return $this;
  }
  
  public function setDerechos($valor)
  {
    $this->getLibro()->setRights($valor);
    return $this;
  }
  
  public function addCubierta($texto, $nombre = 'Cubierta', $fichero = 'cubierta.html')
  {
    $this->getLibro()->addChapter($nombre, $fichero, $this->cabeceraXhtml.'<h1>'.$nombre.'</h1>'."<p id=\"cubierta\">$texto</p>".$this->pieXhtml);
    return $this;
  }
  
  public function addCapitulo($texto, $nombre = null, $fichero = null)
  {
    $this->getLibro()->addChapter($nombre, $fichero, $this->cabeceraXhtml.str_replace("\n", "", $texto).$this->pieXhtml);
    return $this;
  }
  
  public function publicar()
  {
    $this->getLibro()->finalize();
    return $this;
  }

  public function publicarYEnviar()
  {
    $this->publicar();
    return $this->getLibro()->sendBook(ehUtilesCadena::cadenaParaURL($this->getLibro()->getTitle()));
  }
}