<?php

/**
 * tdhAsociacionBusqueda form base class.
 *
 * @method tdhAsociacionBusqueda getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhAsociacionBusquedaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'usuario_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'localidad'        => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'descripcion'      => new sfWidgetFormTextarea(),
      'descripcion_html' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'usuario_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'localidad'        => new sfValidatorString(array('max_length' => 255)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'descripcion'      => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'descripcion_html' => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_asociacion_busqueda[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhAsociacionBusqueda';
  }

}
