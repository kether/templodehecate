<?php

/**
 * tdhSorteo form base class.
 *
 * @method tdhSorteo getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhSorteoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'estado_visible'    => new sfWidgetFormInputCheckbox(),
      'estado_abierto'    => new sfWidgetFormInputCheckbox(),
      'nombre'            => new sfWidgetFormInputText(),
      'entradilla'        => new sfWidgetFormInputText(),
      'aclaraciones'      => new sfWidgetFormTextarea(),
      'mensaje'           => new sfWidgetFormInputText(),
      'desde'             => new sfWidgetFormDateTime(),
      'hasta'             => new sfWidgetFormDateTime(),
      'sufijo'            => new sfWidgetFormInputText(),
      'url'               => new sfWidgetFormInputText(),
      'semilla'           => new sfWidgetFormInputText(),
      'participantes_min' => new sfWidgetFormInputText(),
      'participantes_max' => new sfWidgetFormInputText(),
      'participantes_num' => new sfWidgetFormInputText(),
      'descripcion'       => new sfWidgetFormTextarea(),
      'descripcion_html'  => new sfWidgetFormTextarea(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'slug'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_visible'    => new sfValidatorBoolean(array('required' => false)),
      'estado_abierto'    => new sfValidatorBoolean(array('required' => false)),
      'nombre'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'entradilla'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'aclaraciones'      => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'mensaje'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'desde'             => new sfValidatorDateTime(),
      'hasta'             => new sfValidatorDateTime(),
      'sufijo'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'semilla'           => new sfValidatorInteger(array('required' => false)),
      'participantes_min' => new sfValidatorInteger(array('required' => false)),
      'participantes_max' => new sfValidatorInteger(array('required' => false)),
      'participantes_num' => new sfValidatorInteger(array('required' => false)),
      'descripcion'       => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'descripcion_html'  => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'slug'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'tdhSorteo', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('tdh_sorteo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhSorteo';
  }

}
