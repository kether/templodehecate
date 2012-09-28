<?php

/**
 * tdhMenu form base class.
 *
 * @method tdhMenu getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhMenuForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'estado_portada' => new sfWidgetFormInputCheckbox(),
      'nombre'         => new sfWidgetFormInputText(),
      'ordinal'        => new sfWidgetFormInputText(),
      'descripcion'    => new sfWidgetFormInputText(),
      'enlace'         => new sfWidgetFormInputText(),
      'slug'           => new sfWidgetFormInputText(),
      'menu_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('tdhMenu'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_portada' => new sfValidatorBoolean(array('required' => false)),
      'nombre'         => new sfValidatorString(array('max_length' => 50)),
      'ordinal'        => new sfValidatorInteger(array('required' => false)),
      'descripcion'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'enlace'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'menu_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('tdhMenu'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'tdhMenu', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('tdh_menu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhMenu';
  }

}
