<?php

/**
 * tdhAnuncio form base class.
 *
 * @method tdhAnuncio getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhAnuncioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'activo'      => new sfWidgetFormInputCheckbox(),
      'nombre'      => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormInputText(),
      'url'         => new sfWidgetFormInputText(),
      'vistas'      => new sfWidgetFormInputText(),
      'clicks'      => new sfWidgetFormInputText(),
      'temporal'    => new sfWidgetFormInputCheckbox(),
      'es_flash'    => new sfWidgetFormInputCheckbox(),
      'es_codigo'   => new sfWidgetFormInputCheckbox(),
      'codigo'      => new sfWidgetFormTextarea(),
      'desde'       => new sfWidgetFormDateTime(),
      'hasta'       => new sfWidgetFormDateTime(),
      'tipo_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'slug'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'activo'      => new sfValidatorBoolean(array('required' => false)),
      'nombre'      => new sfValidatorString(array('max_length' => 64)),
      'descripcion' => new sfValidatorString(array('max_length' => 255)),
      'url'         => new sfValidatorString(array('max_length' => 255)),
      'vistas'      => new sfValidatorInteger(array('required' => false)),
      'clicks'      => new sfValidatorInteger(array('required' => false)),
      'temporal'    => new sfValidatorBoolean(array('required' => false)),
      'es_flash'    => new sfValidatorBoolean(array('required' => false)),
      'es_codigo'   => new sfValidatorBoolean(array('required' => false)),
      'codigo'      => new sfValidatorString(array('max_length' => 1000)),
      'desde'       => new sfValidatorDateTime(),
      'hasta'       => new sfValidatorDateTime(),
      'tipo_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'tdhAnuncio', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('tdh_anuncio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhAnuncio';
  }

}
