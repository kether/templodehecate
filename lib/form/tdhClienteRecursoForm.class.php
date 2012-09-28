<?php

class tdhClienteRecursoForm extends tdhAdminRecursoForm
{  
  public function configure()
  {
    parent::configure();
    
    $PrimerMensaje = $this->getEmbeddedForm('PrimerMensaje');
    $Recurso = $this->getEmbeddedForm('Recurso');
    
    $PrimerMensaje->getWidgetSchema()->setLabels(array(
      'asunto' => 'Nombre (obligatorio)',
      'cuerpo' => 'Descripción (obligatorio)'
    ));
    
    if($this->usuario->esColaborador($this->seccion->getSlug()))
    {
      $this->useFields(array(
        'image',
        'PrimerMensaje',
        'Recurso',
        'pdf'
      ));
      
      $PrimerMensaje->useFields(array('asunto', 'cuerpo', 'visible_desde', 'estado_activo'));
      $PrimerMensaje->setWidget('visible_desde', new ehWidgetFormJQueryDate(array('label' => 'Visible en la web desde', 'culture' => sfConfig::get('sf_default_culture'), 'date_widget' => new sfWidgetFormI18nDate(array('culture' => sfConfig::get('sf_default_culture', 'es'))))));
    }
    else
    {
      $PrimerMensaje->useFields(array('asunto', 'cuerpo'));
      
      $this->useFields(array(
        'image',
        'PrimerMensaje',
        'Recurso',
        'pdf'
      ));
    }
    
    $Recurso->useFields(array('autor', 'tipo_id', 'licencia_id', 'entradilla'));
    
    $this->embedForm('PrimerMensaje', $PrimerMensaje);
    $this->embedForm('Recurso', $Recurso);
    
    $this->widgetSchema->setNameFormat('recurso[%s]');
  }
  
  public function doSave($con = null)
  {
    if($this->isNew())
    {      
      $this->getEmbeddedForm('PrimerMensaje')->getObject()->setMarkdown(true)->setBbcode(false);
      $this->getObject()->setTablonId($this->seccion->getTablonId());
      $this->getEmbeddedForm('Recurso')->getObject()->setSeccionId($this->seccion->getId())->setAceptaDonativos(false);
      $this->getEmbeddedForm('PrimerMensaje')->getObject()->setUsuarioId($this->usuario->getUserId());
      
      parent::doSave($con);
      
      $this->sendNotifications(sprintf('Se ha enviado un recurso con el nombre **%s** en la sección de **%s**.', $this->getEmbeddedForm('PrimerMensaje')->getObject()->getAsunto(), $this->seccion->getNombre()), sprintf('Nuevo recurso en %s', $this->seccion->getNombre()));
    }
    else
    {
      parent::doSave($con);
    }
  }
}