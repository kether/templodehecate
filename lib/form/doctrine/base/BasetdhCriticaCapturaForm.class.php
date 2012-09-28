<?php

/**
 * tdhCriticaCaptura form base class.
 *
 * @method tdhCriticaCaptura getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhCriticaCapturaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'comentario' => new sfWidgetFormInputText(),
      'fichero'    => new sfWidgetFormInputText(),
      'tam_peq'    => new sfWidgetFormInputCheckbox(),
      'tam_med'    => new sfWidgetFormInputCheckbox(),
      'tam_gra'    => new sfWidgetFormInputCheckbox(),
      'critica_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Critica'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'comentario' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fichero'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tam_peq'    => new sfValidatorBoolean(array('required' => false)),
      'tam_med'    => new sfValidatorBoolean(array('required' => false)),
      'tam_gra'    => new sfValidatorBoolean(array('required' => false)),
      'critica_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Critica'))),
    ));

    $this->widgetSchema->setNameFormat('tdh_critica_captura[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhCriticaCaptura';
  }

}
