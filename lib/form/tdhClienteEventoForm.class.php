<?php

class tdhClienteEventoForm extends tdhAdminEventoForm
{
  public function configure()
  {
    parent::configure();
    
    $PrimerMensaje = $this->getEmbeddedForm('PrimerMensaje');
    $Evento = $this->getEmbeddedForm('Evento');
    
    $PrimerMensaje->getWidgetSchema()->setLabels(array(
      'asunto' => 'Nombre del evento/jornada (obligatorio)',
      'cuerpo' => 'Descripción (obligatorio)'
    ));
    
    if($this->usuario->esColaborador())
    {
      $this->useFields(array(
        'estado_oculto',
        'imagen',
        'PrimerMensaje',
        'Evento'
      ));
      
      $PrimerMensaje->useFields(array(
        'asunto', 
        'cuerpo', 
        'visible_desde'
      ));
      
      $PrimerMensaje->setWidget('visible_desde', new ehWidgetFormJQueryDate(array('image' => '/images/btns/calender.png', 'label' => 'Visible en la web desde', 'culture' => sfConfig::get('sf_default_culture'), 'date_widget' => new sfWidgetFormI18nDate(array('culture' => sfConfig::get('sf_default_culture', 'es'))))));
    }
    else
    {
      $PrimerMensaje->useFields(array('asunto', 'cuerpo'));
      
      $this->useFields(array(
        'imagen',
        'PrimerMensaje',
        'Evento'
      ));
    }
    
    $Evento->useFields(array(
      'fecha_inicio',
      'fecha_fin',
      'direccion',
      'localidad',
      'region',
      'pais'
    ));
    
    $this->embedForm('PrimerMensaje', $PrimerMensaje);
    $this->embedForm('Evento', $Evento);
    
    $this->widgetSchema->setNameFormat('evento[%s]');
  }
  
  public function doSave($con = null)
  {
    if($this->isNew())
    {      
      $this->getEmbeddedForm('PrimerMensaje')->getObject()->setMarkdown(true)->setBbcode(false);
      
      if(!($tablon = Doctrine::getTable('ehForoTablon')->findOneBy('slug', tdhConfig::get('foro_slug_generico_eventos', 'eventos'))))
      {
        throw new Exception('No se encontró el tablón de eventos para la agenda.');
      }
      
      $this->getObject()->setTablon($tablon);
      $this->getEmbeddedForm('PrimerMensaje')->getObject()->setUsuarioId($this->usuario->getUserId());
      
      parent::doSave($con);
      
      $this->sendNotifications(sprintf('Se ha enviado el evento «**%s**» para ser aprobado.', $this->getEmbeddedForm('PrimerMensaje')->getObject()->getAsunto()), 'Nueva evento');
    }
    else
    {
      parent::doSave($con);
    }
  }
}