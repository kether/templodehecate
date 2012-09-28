<?php
class tdhComentarioForm extends ehForoClienteMensajeForm
{  
  public function configure()
  {
    parent::configure();
    
    if(isset($this['nombre_invitado']))
    {
      $this->useFields(array('cuerpo', 'nombre_invitado'));
    }
    else
    {
      $this->useFields(array('cuerpo'));
    }
    
    
    $this->setDefault('hilo_id', $this->getOption('hilo_id', null));
  }
}