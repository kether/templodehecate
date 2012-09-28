<?php

class tdhClienteCriticaForm extends tdhAdminCriticaForm
{
  public function configure()
  {
    parent::configure();
    
    $PrimerMensaje = $this->getEmbeddedForm('PrimerMensaje');
    $Critica = $this->getEmbeddedForm('Critica');
    
    $PrimerMensaje->getWidgetSchema()->setLabels(array(
      'asunto' => 'Nombre del producto (obligatorio)',
      'cuerpo' => 'Descripción (obligatorio)'
    ));
    
    $Critica->getWidgetSchema()->setLabels(array(
      'precio' => 'Precio (separa los decimales con un punto, p.e.: "49.95")',
      'nota'   => 'Nota (del 1 al 10 y separa los decimales con un punto, p.e.: "9.5")',
    ));
    
    if($this->usuario->esColaborador($this->seccion->getSlug()))
    {
      $this->useFields(array(
        'image',
        'PrimerMensaje',
        'Critica'
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
        'Critica'
      ));
    }
    
    $Critica->useFields(array('estado_basico', 'fecha_publicacion', 'autor', 'paginas', 'idioma', 'precio', 'moneda', 'nota', 'editor_id'));
    
    $this->embedForm('PrimerMensaje', $PrimerMensaje);
    $this->embedForm('Critica', $Critica);
    
    $this->widgetSchema->setNameFormat('critica[%s]');
  }
  
  public function doSave($con = null)
  {
    if($this->isNew())
    {      
      $this->getEmbeddedForm('PrimerMensaje')->getObject()->setMarkdown(true)->setBbcode(false);
      $this->getObject()->setTablonId($this->seccion->getTablonId());
      $this->getEmbeddedForm('Critica')->getObject()->setSeccionId($this->seccion->getId());
      $this->getEmbeddedForm('PrimerMensaje')->getObject()->setUsuarioId($this->usuario->getUserId());
      
      parent::doSave($con);
      
      $this->sendNotifications(sprintf('Se ha enviado una reseña de **%s** para la sección de **%s**.', $this->getEmbeddedForm('PrimerMensaje')->getObject()->getAsunto(), $this->seccion->getNombre()), sprintf('Nueva reseña en %s', $this->seccion->getNombre()));
    }
    else
    {
      parent::doSave($con);
    }
  }
}