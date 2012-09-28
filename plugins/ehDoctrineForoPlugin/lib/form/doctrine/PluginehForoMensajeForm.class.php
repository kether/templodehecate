<?php

/**
 * PluginehForoMensaje form.
 *
 * @package    form
 * @subpackage ehForoMensaje
 */
abstract class PluginehForoMensajeForm extends BaseehForoMensajeForm
{
  protected $user = null;
  
  public function configure()
  {
    $this->user = $this->getOption('user', sfContext::getInstance()->getUser());
    
    $this->useFields(array(
  	  'estado_activo',
  	  'html',
  	  'bbcode',
  	  'nl2br',
  	  'emoticonos',
  	  'markdown',
  	  'firma',
  	  'nombre_invitado',
  	  'asunto',
  	  'cuerpo',
  	  'hilo_id'
    ));
    
    /*
    unset(
      $this['ip'],
      $this['slug'],
      $this['tiene_adjuntos'],
      $this['karma'],
      $this['cuerpo_html'],
      $this['created_at'],
      $this['updated_at']
    );
    */
    
    $this->getWidgetSchema()->setLabels(array(
      'estado_activo'   => '¿Visible?',
      'nl2br'           => 'Salto de línea',
      'html'            => 'HTML',
      'bbcode'          => 'BBCode',
      'nombre_invitado' => 'Seudónimo'
    ));
    
    $this->validatorSchema['nombre_invitado'] = new sfValidatorString(array('required' => false, 'max_length' => 15));
    
    $this->widgetSchema['hilo_id']            = new sfWidgetFormInputHidden();
    $this->widgetSchema['visible_desde']      = new sfWidgetFormI18nDateTime(array('culture' => sfConfig::get('sf_default_culture')));
    $this->widgetSchema['nombre_usuario']     = new sfWidgetFormInputText(array('label' => 'Nombre de usuario'));
    
    $this->validatorSchema['visible_desde']   = new sfValidatorDateTime(array('required' => false));
    $this->validatorSchema['cuerpo']          = new sfValidatorString(array('required' => true));
    $this->validatorSchema['nombre_usuario']  = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'column' => 'username', 'required' => false));
    
    // Hay que sustituir esto
    if($this->user->isAuthenticated())
    {
      $this->widgetSchema['nombre_invitado']   = new sfWidgetFormInputHidden();
      $this->setDefault('nombre_usuario', $this->isNew() ? $this->user->getUsername() : $this->getObject()->getUsuario()->getUsername());
    }
  }
}