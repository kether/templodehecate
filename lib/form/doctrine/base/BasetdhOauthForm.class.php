<?php

/**
 * tdhOauth form base class.
 *
 * @method tdhOauth getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhOauthForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'uid'          => new sfWidgetFormInputText(),
      'servicio'     => new sfWidgetFormChoice(array('choices' => array('facebook' => 'facebook', 'twitter' => 'twitter', 'google' => 'google'))),
      'token'        => new sfWidgetFormInputText(),
      'token_secret' => new sfWidgetFormInputText(),
      'usuario_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'uid'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'servicio'     => new sfValidatorChoice(array('choices' => array(0 => 'facebook', 1 => 'twitter', 2 => 'google'), 'required' => false)),
      'token'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'token_secret' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'usuario_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'tdhOauth', 'column' => array('usuario_id', 'servicio')))
    );

    $this->widgetSchema->setNameFormat('tdh_oauth[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhOauth';
  }

}
