<?php

class tdhClienteAsociacionForm extends tdhAsociacionForm
{
  public function setup()
  {
    parent::setup();
    
    $this->useFields(array(
      'nombre',
    	'tipo_id',
      'direccion',
      'localidad',
      'region',
      'pais',
      'web',
      'plazas_abiertas',
      'acepta_invitaciones',
      'descripcion'
    ));
    
    $this->widgetSchema->setNameFormat('asociacion[%s]');
    $this->getWidgetSchema()->setFormFormatterName('templo');
  }
}