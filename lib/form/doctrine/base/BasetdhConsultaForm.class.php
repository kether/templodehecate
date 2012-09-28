<?php

/**
 * tdhConsulta form base class.
 *
 * @method tdhConsulta getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhConsultaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'codigo'      => new sfWidgetFormInputText(),
      'nombre'      => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormTextarea(),
      'email'       => new sfWidgetFormInputText(),
      'ip'          => new sfWidgetFormInputText(),
      'resuelto'    => new sfWidgetFormInputCheckbox(),
      'usuario_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'tipo_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'codigo'      => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'nombre'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descripcion' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ip'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'resuelto'    => new sfValidatorBoolean(array('required' => false)),
      'usuario_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'required' => false)),
      'tipo_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('tdh_consulta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhConsulta';
  }

}
