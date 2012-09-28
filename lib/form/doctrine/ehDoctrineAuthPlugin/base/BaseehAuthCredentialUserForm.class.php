<?php

/**
 * ehAuthCredentialUser form base class.
 *
 * @method ehAuthCredentialUser getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehAuthCredentialUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'       => new sfWidgetFormInputHidden(),
      'credential_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'user_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
      'credential_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('credential_id')), 'empty_value' => $this->getObject()->get('credential_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('eh_auth_credential_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehAuthCredentialUser';
  }

}
