<?php

/**
 * tdhCriticaVideo form base class.
 *
 * @method tdhCriticaVideo getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhCriticaVideoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'comentario' => new sfWidgetFormInputText(),
      'medio'      => new sfWidgetFormChoice(array('choices' => array('Youtube' => 'Youtube', 'Dailymotion' => 'Dailymotion'))),
      'url'        => new sfWidgetFormInputText(),
      'critica_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Critica'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'comentario' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'medio'      => new sfValidatorChoice(array('choices' => array(0 => 'Youtube', 1 => 'Dailymotion'), 'required' => false)),
      'url'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'critica_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Critica'))),
    ));

    $this->widgetSchema->setNameFormat('tdh_critica_video[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhCriticaVideo';
  }

}
