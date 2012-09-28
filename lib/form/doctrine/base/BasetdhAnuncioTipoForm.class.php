<?php

/**
 * tdhAnuncioTipo form base class.
 *
 * @method tdhAnuncioTipo getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhAnuncioTipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'nombre'             => new sfWidgetFormInputText(),
      'anchura'            => new sfWidgetFormInputText(),
      'altura'             => new sfWidgetFormInputText(),
      'multiple'           => new sfWidgetFormInputCheckbox(),
      'rotativo'           => new sfWidgetFormInputCheckbox(),
      'codigo_alternativo' => new sfWidgetFormTextarea(),
      'slug'               => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'             => new sfValidatorString(array('max_length' => 128)),
      'anchura'            => new sfValidatorInteger(array('required' => false)),
      'altura'             => new sfValidatorInteger(array('required' => false)),
      'multiple'           => new sfValidatorBoolean(array('required' => false)),
      'rotativo'           => new sfValidatorBoolean(array('required' => false)),
      'codigo_alternativo' => new sfValidatorString(array('max_length' => 1000)),
      'slug'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'tdhAnuncioTipo', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('tdh_anuncio_tipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhAnuncioTipo';
  }

}
