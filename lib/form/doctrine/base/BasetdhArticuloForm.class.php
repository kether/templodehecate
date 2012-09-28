<?php

/**
 * tdhArticulo form base class.
 *
 * @method tdhArticulo getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhArticuloForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'es_aprobado' => new sfWidgetFormInputCheckbox(),
      'tipo'        => new sfWidgetFormChoice(array('choices' => array('miscelanea' => 'miscelanea', 'pie' => 'pie', 'cabecera' => 'cabecera'))),
      'hilo_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'es_aprobado' => new sfValidatorBoolean(array('required' => false)),
      'tipo'        => new sfValidatorChoice(array('choices' => array(0 => 'miscelanea', 1 => 'pie', 2 => 'cabecera'), 'required' => false)),
      'hilo_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'))),
    ));

    $this->widgetSchema->setNameFormat('tdh_articulo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhArticulo';
  }

}
