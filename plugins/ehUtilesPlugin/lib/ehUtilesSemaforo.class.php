<?php

class ehUtilesSemaforo
{
  protected $id;
  protected $semId;
  protected $isAcquired = false;
  protected $isNotSemFunctions = false;
  protected $fichero = '';

  function __construct($id, $fichero = '')
  {
    if(!function_exists('sem_get'))
    {
    	$this->isNotSemFunctions = true;
    }
    
    $this->init($id, $fichero);
  }

  public function init($id, $fichero = '')
  {
    $this->id = $id;

    if($this->isNotSemFunctions)
    {
      if(empty($fichero))
      {
        $fichero = sfConfig::get('app_eh_utiles_plugin_fichero_sem', sfConfig::get('sf_data_dir').'/semaforo');
      }
      
      $this->fichero = $fichero.'.'.$this->id;
    }
    else
    {
      if(!($this->semId = sem_get($this->id, 1)))
      {
        throw new Exception('No se pudo obtener el ID del semáforo.');
      }
    }
  }

  public function acquire()
  {
    if($this->isNotSemFunctions)
    {
      if(file_exists($this->fichero))
      {
      	$this->isAcquired = false;
      }
      else
      {
      	touch($this->fichero);
      	$this->isAcquired = true;
      }
    }
    else
    {
      $this->isAcquired = sem_acquire($this->semId);
    }
        
    return $this->isAcquired;
  }

  public function release()
  {
    if(!$this->isAcquired)
    {
      return true;
    }

    if($this->isNotSemFunctions)
    {
      @unlink($this->fichero);
    }
    else
    {
      if(!sem_release($this->semId))
      {
        throw new Exception('No se pudo desbloquear el semáforo.');
      }
    }

    $this->isAcquired = false;
    return true;
  }

  public function getId()
  {
    return $this->semId;
  }
}