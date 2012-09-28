<?php

class ehForoClientePerfilForm extends ehForoPerfilForm
{  
  public function configure()
  {
    $this->useFields(array(
      'nick',
      'sexo',
      'fecha_nacimiento',
      'email',
      'web',
      'residencia',
      'pais',
      'idioma',
      'zona_horaria',
      'firma'
    ));
    
    $this->getWidgetSchema()->setFormFormatterName('foro');
  }
}