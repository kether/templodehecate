<?php

/**
 * ehForoClienteTemaForm form.
 *
 * @package    ehForoPlugin
 * @subpackage form
 * @author     Pablo Floriano
 */
class ehForoClienteTemaForm extends PluginehForoHiloForm
{
  protected $user = null;
  
  public function configure()
  {
    parent::configure();
    
    $this->user = $this->getOption('user', sfContext::getInstance()->getUser());
    
    $this->useFields(array(
      'tablon_id',
    ));
    
    $this->widgetSchema['tablon_id'] = new sfWidgetFormInputHidden();
    $this->embedForm('mensaje', new ehForoClienteMensajeForm(null, array('user' => $this->user)));
  }
  
  /**
   * @return ehForoClienteMensajeForm
   */
  public function getEmbeddedMensaje()
  {
    return $this->embeddedForms['mensaje'];
  }
  
  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if(is_null($this->getEmbeddedMensaje()->getObject()->getUsuarioId()))
    {
      $this->getEmbeddedMensaje()->getObject()->setHiloId($this->getObject()->getId());
      $this->getEmbeddedMensaje()->getObject()->setUsuarioId($this->user->getUserId());
    }
    
    parent::saveEmbeddedForms($con, $forms);
    
    $this->getObject()->setPrimerMensajeId($this->getEmeddedMensaje()->getObject()->getId());
    $this->getObject()->setUltimoMensajeId($this->getEmeddedMensaje()->getObject()->getId());
    $this->getObject()->save();
  }
  
  /**
   * DEPRECATED
   * @see ehForoClienteTemaForm::getEmbeddedMensaje()
   */
  public function getEmeddedMensaje()
  {
    return $this->getEmbeddedMensaje();
  }
}
