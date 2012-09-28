<?php

class tdhClienteNoticiaForm extends tdhAdminNoticiaForm
{
  public function configure()
  {
    parent::configure();
    
    $PrimerMensaje = $this->getEmbeddedForm('PrimerMensaje');
    $Noticia = $this->getEmbeddedForm('Noticia');
    
    $PrimerMensaje->getWidgetSchema()->setLabels(array(
      'asunto' => 'Titular de la noticia (obligatorio)',
      'cuerpo' => 'Descripción (obligatorio)'
    ));
    
    $Noticia->getWidgetSchema()->setLabels(array(
      'nombre_fuente' => 'Fuente de la noticia',
      'url_fuente' => 'URL (p.e.: http://www.ejemplo.com)'
    ));
    
    if($this->usuario->esColaborador($this->seccion->getSlug()))
    {
      $this->useFields(array(
        'imagen',
        'PrimerMensaje',
        'Noticia'
      ));
      
      $PrimerMensaje->useFields(array('asunto', 'cuerpo', 'visible_desde', 'estado_activo'));
      $PrimerMensaje->setWidget('visible_desde', new ehWidgetFormJQueryDate(array('label' => 'Visible en la web desde', 'culture' => sfConfig::get('sf_default_culture'), 'date_widget' => new sfWidgetFormI18nDate(array('culture' => sfConfig::get('sf_default_culture', 'es'))))));
    }
    else
    {
      $PrimerMensaje->useFields(array('asunto', 'cuerpo'));
      
      $this->useFields(array(
        'imagen',
        'PrimerMensaje',
        'Noticia'
      ));
    }
    
    $Noticia->useFields(array('nombre_fuente', 'url_fuente', 'entradilla'));
    
    $this->embedForm('PrimerMensaje', $PrimerMensaje);
    $this->embedForm('Noticia', $Noticia);
    
    $this->widgetSchema->setNameFormat('noticia[%s]');
  }
  
  public function doSave($con = null)
  {
    if($this->isNew())
    {      
      $this->getEmbeddedForm('PrimerMensaje')->getObject()->setMarkdown(true)->setBbcode(false);
      $this->getEmbeddedForm('PrimerMensaje')->getObject()->setUsuarioId($this->usuario->getUserId());
      $this->getEmbeddedForm('Noticia')->getObject()->setSeccionId($this->seccion->getId());
      
      parent::doSave($con);
      
      $this->sendNotifications(sprintf('Se ha enviado una noticia con el título **%s** en la sección de **%s**.', $this->getEmbeddedForm('PrimerMensaje')->getObject()->getAsunto(), $this->seccion->getNombre()), sprintf('Nueva noticia en %s', $this->seccion->getNombre()));
    }
    else
    {
      parent::doSave($con);
    }
  }
}