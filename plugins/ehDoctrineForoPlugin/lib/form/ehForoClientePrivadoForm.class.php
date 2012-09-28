<?php

/**
 * ehForoClientePrivadoForm form.
 *
 * @package    ehForoPlugin
 * @subpackage form
 * @author     Pablo Floriano
 */
class ehForoClientePrivadoForm extends PluginehForoMensajePrivadoForm
{
  protected $userId = null;
  
  public function configure()
  {
    parent::configure();
    
    $this->widgetSchema['usuario_destino_id']     = new sfWidgetFormInputHidden();
    
    $this->useFields(array(
    	'usuario_destino_id'
    ));
    
    $mensaje = new ehForoClienteMensajeForm();
    unset($mensaje['cargar_ficheros']);
    
    $this->embedForm('mimensaje', $mensaje);
  }
  
  public function getEmbeddedMensaje()
  {
    return $this->embeddedForms['mimensaje'];
  }

  public function setUserId($userId)
  {
    $this->userId = $userId;
  }
  
  public function saveEmbeddedForms($conn = null, $forms = null)
  {
    $this->getEmbeddedMensaje()->getObject()->setUsuarioId($this->userId);
    parent::saveEmbeddedForms($conn, $forms);
    
    $this->getObject()->setMensajeId($this->getEmbeddedMensaje()->getObject()->getId());
    $this->getObject()->save();
  }
}
