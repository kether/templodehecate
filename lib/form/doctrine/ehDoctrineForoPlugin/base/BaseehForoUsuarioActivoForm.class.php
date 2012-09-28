<?php

/**
 * ehForoUsuarioActivo form base class.
 *
 * @method ehForoUsuarioActivo getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoUsuarioActivoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ip'         => new sfWidgetFormInputHidden(),
      'usuario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'modulo'     => new sfWidgetFormInputText(),
      'accion'     => new sfWidgetFormInputText(),
      'agent'      => new sfWidgetFormInputText(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ip'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ip')), 'empty_value' => $this->getObject()->get('ip'), 'required' => false)),
      'usuario_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'required' => false)),
      'modulo'     => new sfValidatorString(array('max_length' => 128)),
      'accion'     => new sfValidatorString(array('max_length' => 128)),
      'agent'      => new sfValidatorString(array('max_length' => 255)),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_usuario_activo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoUsuarioActivo';
  }

}
