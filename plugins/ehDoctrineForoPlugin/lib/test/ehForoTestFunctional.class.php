<?php

class ehForoTestFunctional extends sfTestFunctional
{  
  const CREADO_USERNAME = 'micuenta';
  const CREADO_PASSWORD = 'mipassword';
  const CREADO_EMAIL    = 'micuenta@email.com';
  
  public function cargarDatos()
  {
    //Doctrine::loadData(sfConfig::get('sf_test_dir').'/fixtures');
    
    Doctrine::loadData(dirname(__FILE__).'/../../../test/fixtures');
    return $this;
  }
  
  public function getUltimoHilo($tablonId = null)
  {
    return Doctrine::getTable('ehForoHilo')->getAutorizadosPorTablonId($tablonId)->getFirst();
  }
  
  public function getPrimerTablon($seccionId)
  {
    return Doctrine::getTable('ehForoTablon')->getEnOrdenPorSeccionId($seccionId)->getFirst();
  }
  
  public function getPrimeraSeccion()
  {
    return Doctrine::getTable('ehForoSeccion')->getEnOrden()->getFirst();
  }
  
  public function borrarPerfilCreado()
  {
    Doctrine_Query::create()->delete('ehAuthUser u')->where('u.username = ?', self::CREADO_USERNAME)->execute();
        
    return $this;
  }
}