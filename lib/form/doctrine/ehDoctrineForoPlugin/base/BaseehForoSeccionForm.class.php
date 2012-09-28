<?php

/**
 * ehForoSeccion form base class.
 *
 * @method ehForoSeccion getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoSeccionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'estado_oculto' => new sfWidgetFormInputCheckbox(),
      'ordinal'       => new sfWidgetFormInputText(),
      'nombre'        => new sfWidgetFormInputText(),
      'descripcion'   => new sfWidgetFormInputText(),
      'slug'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_oculto' => new sfValidatorBoolean(array('required' => false)),
      'ordinal'       => new sfValidatorInteger(array('required' => false)),
      'nombre'        => new sfValidatorString(array('max_length' => 255)),
      'descripcion'   => new sfValidatorString(array('max_length' => 255)),
      'slug'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ehForoSeccion', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('eh_foro_seccion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoSeccion';
  }

}
