<?php

/**
 * armFortalezaAlianza form base class.
 *
 * @method armFortalezaAlianza getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasearmFortalezaAlianzaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'tiene_mantenimiento' => new sfWidgetFormInputCheckbox(),
      'cantidad'            => new sfWidgetFormInputText(),
      'fortaleza_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fortalezas'), 'add_empty' => false)),
      'alianza_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alianza'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'tiene_mantenimiento' => new sfValidatorBoolean(array('required' => false)),
      'cantidad'            => new sfValidatorInteger(array('required' => false)),
      'fortaleza_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fortalezas'))),
      'alianza_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alianza'))),
    ));

    $this->widgetSchema->setNameFormat('arm_fortaleza_alianza[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'armFortalezaAlianza';
  }

}
