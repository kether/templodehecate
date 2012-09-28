<?php

/**
 * tdhSorteoCondicion form base class.
 *
 * @method tdhSorteoCondicion getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhSorteoCondicionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'nombre'      => new sfWidgetFormInputText(),
      'url'         => new sfWidgetFormInputText(),
      'propietario' => new sfWidgetFormInputText(),
      'tipo'        => new sfWidgetFormChoice(array('choices' => array('facebook' => 'facebook', 'twitter' => 'twitter'))),
      'sorteo_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sorteo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'propietario' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tipo'        => new sfValidatorChoice(array('choices' => array(0 => 'facebook', 1 => 'twitter'), 'required' => false)),
      'sorteo_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sorteo'))),
    ));

    $this->widgetSchema->setNameFormat('tdh_sorteo_condicion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhSorteoCondicion';
  }

}
