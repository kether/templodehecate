<?php

/**
 * ehForoKarma form base class.
 *
 * @method ehForoKarma getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoKarmaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'mensaje_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mensaje'), 'add_empty' => false)),
      'usuario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'puntos'     => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mensaje_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mensaje'))),
      'usuario_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'puntos'     => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_karma[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoKarma';
  }

}
