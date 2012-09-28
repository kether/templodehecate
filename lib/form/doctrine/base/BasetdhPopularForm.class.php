<?php

/**
 * tdhPopular form base class.
 *
 * @method tdhPopular getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhPopularForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'visitas'    => new sfWidgetFormInputText(),
      'fecha'      => new sfWidgetFormDate(),
      'seccion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'visitas'    => new sfValidatorInteger(array('required' => false)),
      'fecha'      => new sfValidatorDate(),
      'seccion_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'))),
    ));

    $this->widgetSchema->setNameFormat('tdh_popular[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhPopular';
  }

}
