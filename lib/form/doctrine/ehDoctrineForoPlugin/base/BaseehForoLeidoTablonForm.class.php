<?php

/**
 * ehForoLeidoTablon form base class.
 *
 * @method ehForoLeidoTablon getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoLeidoTablonForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'usuario_id' => new sfWidgetFormInputHidden(),
      'tablon_id'  => new sfWidgetFormInputHidden(),
      'read_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'usuario_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('usuario_id')), 'empty_value' => $this->getObject()->get('usuario_id'), 'required' => false)),
      'tablon_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('tablon_id')), 'empty_value' => $this->getObject()->get('tablon_id'), 'required' => false)),
      'read_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_leido_tablon[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoLeidoTablon';
  }

}
