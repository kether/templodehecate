<?php

class tdhTestFunctional extends sfTestFunctional
{
  /**
   * Trunca los datos de la BD y carga de nuevo los fixtures.
   * 
   * @return tdhTestFunctional Se devuelve la instancia de sí mismo
   */
  public function cargarDatos()
  {
    Doctrine::loadData(sfConfig::get('sf_test_dir').'/fixtures');
    
    return $this;
  }
  
  /**
   * Devuelve la primera sección ordenada por visitas de ayer (descendente) y por nombre (ascendente) que encuentre.
   * 
   * @param boolean $conUrl Permitir que la primera sección tenga URL propia (falso por defecto)
   * @return tdhSeccion Un objeto tdhSeccion
   */
  public function getPrimeraSeccion($conUrl = null)
  {
    $q = Doctrine::getTable('tdhSeccion')->autorizados();
    
    $q->addOrderBy('s.nombre ASC');
    
    if($conUrl === true)
    {
      $q->addWhere('s.url != ?', '');
    }
    elseif($conUrl === false)
    {
      $q->addWhere('s.url = ?', '');
    }
    
    return $q->fetchOne();
  }
  
  /**
   * Devuelve la primera noticia visible que encuentre.
   * 
   * @return tdhNoticia Un objeto tdhNoticia
   */
  public function getUltimaNoticia()
  {
    $noticias = Doctrine::getTable('tdhNoticia')->getAutorizados(1, array('solo_noticias' => true));
    
    return $noticias->getFirst();
  }
  
  /**
   * Devuelve el primer evento visible archivado
   * 
   * @return tdhEvento Un objeto tdhEvento
   */
  public function getUltimoEvento()
  {
    $evento = Doctrine::getTable('tdhEvento')->getAutorizados(1);
    
    return $evento->getFirst();
  }
    
  public function autenticarse()
  {
    return $this->post('/usuario/autenticar', array('username' => 'admin', 'password' => 'admin'));
  }
}