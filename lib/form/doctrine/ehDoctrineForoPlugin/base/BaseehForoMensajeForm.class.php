<?php

/**
 * ehForoMensaje form base class.
 *
 * @method ehForoMensaje getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoMensajeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'estado_activo'   => new sfWidgetFormInputCheckbox(),
      'tiene_adjuntos'  => new sfWidgetFormInputCheckbox(),
      'estado_staff'    => new sfWidgetFormInputCheckbox(),
      'nombre_invitado' => new sfWidgetFormInputText(),
      'ip'              => new sfWidgetFormInputText(),
      'asunto'          => new sfWidgetFormInputText(),
      'html'            => new sfWidgetFormInputCheckbox(),
      'bbcode'          => new sfWidgetFormInputCheckbox(),
      'nl2br'           => new sfWidgetFormInputCheckbox(),
      'emoticonos'      => new sfWidgetFormInputCheckbox(),
      'markdown'        => new sfWidgetFormInputCheckbox(),
      'firma'           => new sfWidgetFormInputCheckbox(),
      'karma'           => new sfWidgetFormInputText(),
      'visible_desde'   => new sfWidgetFormDateTime(),
      'hilo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => true)),
      'usuario_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'slug'            => new sfWidgetFormInputText(),
      'cuerpo'          => new sfWidgetFormTextarea(),
      'cuerpo_html'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_activo'   => new sfValidatorBoolean(array('required' => false)),
      'tiene_adjuntos'  => new sfValidatorBoolean(array('required' => false)),
      'estado_staff'    => new sfValidatorBoolean(array('required' => false)),
      'nombre_invitado' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ip'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'asunto'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'html'            => new sfValidatorBoolean(array('required' => false)),
      'bbcode'          => new sfValidatorBoolean(array('required' => false)),
      'nl2br'           => new sfValidatorBoolean(array('required' => false)),
      'emoticonos'      => new sfValidatorBoolean(array('required' => false)),
      'markdown'        => new sfValidatorBoolean(array('required' => false)),
      'firma'           => new sfValidatorBoolean(array('required' => false)),
      'karma'           => new sfValidatorInteger(array('required' => false)),
      'visible_desde'   => new sfValidatorDateTime(),
      'hilo_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'required' => false)),
      'usuario_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'slug'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cuerpo'          => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'cuerpo_html'     => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ehForoMensaje', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('eh_foro_mensaje[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoMensaje';
  }

}
