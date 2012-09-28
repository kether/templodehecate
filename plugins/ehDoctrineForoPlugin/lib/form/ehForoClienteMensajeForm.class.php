<?php

/**
 * ehForoClienteMensaje form.
 *
 * @package    ehForoPlugin
 * @subpackage form
 * @author     Pablo Floriano
 */
class ehForoClienteMensajeForm extends PluginehForoMensajeForm
{  
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array(
  	  'html',
  	  'bbcode',
  	  'nl2br',
  	  'emoticonos',
  	  'markdown',
  	  'firma',
  	  'nombre_invitado',
  	  'asunto',
  	  'cuerpo'
    ));
    
    if($this->user->isAuthenticated())
    {
      if(ehForoConfig::permisoCargarFicheros(false))
      {
        $this->widgetSchema['cargar_ficheros']     = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['cargar_ficheros']  = new sfValidatorBoolean();
      }
      
      unset($this['nombre_invitado']);
    }
  }
  
  public function doSave($con = null)
  {
    if($this->isNew() && !$this->getValue('usuario_id'))
    {
      $this->getObject()->setUsuarioId($this->user->getUserId());
    }
    
    parent::doSave($con);
  }
}
