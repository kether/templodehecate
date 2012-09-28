<?php

class tdhClienteVotoCriticaForm extends tdhCriticaNotaForm
{
  static $notas = array('0.00' => 0, '1.00' => 1, '2.00' => 2, '3.00' => 3, '4.00' => 4, '5.00' => 5, '6.00' => 6, '7.00' => 7, '8.00' => 8, '9.00' => 9, '10.00' => 10);
  
  public function configure()
  {
    $this->useFields(array('nota'));
    
    $this->setWidget('nota', new sfWidgetFormSelect(array('choices' => self::$notas)));
    $this->widgetSchema->setNameFormat('voto[%s]');
    
    if($this->isNew())
    {
      if($this->getOption('critica_id'))
      {
        $this->getObject()->setCriticaId($this->getOption('critica_id'));
      }
      
      if($this->getOption('usuario_id'))
      {
        $this->getObject()->setUsuarioId($this->getOption('usuario_id'));
      }
    }
  }
}