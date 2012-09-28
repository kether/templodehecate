<?php

/**
 * armFortaleza form base class.
 *
 * @method armFortaleza getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasearmFortalezaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'nombre'           => new sfWidgetFormInputText(),
      'es_unica'         => new sfWidgetFormInputCheckbox(),
      'es_mayor'         => new sfWidgetFormInputCheckbox(),
      'slug'             => new sfWidgetFormInputText(),
      'descripcion'      => new sfWidgetFormTextarea(),
      'descripcion_html' => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nombre'           => new sfValidatorString(array('max_length' => 150)),
      'es_unica'         => new sfValidatorBoolean(array('required' => false)),
      'es_mayor'         => new sfValidatorBoolean(array('required' => false)),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descripcion'      => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'descripcion_html' => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'armFortaleza', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('arm_fortaleza[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'armFortaleza';
  }

}
