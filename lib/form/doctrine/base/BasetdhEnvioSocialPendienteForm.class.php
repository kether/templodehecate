<?php

/**
 * tdhEnvioSocialPendiente form base class.
 *
 * @method tdhEnvioSocialPendiente getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhEnvioSocialPendienteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'programado_para' => new sfWidgetFormDateTime(),
      'servicio'        => new sfWidgetFormChoice(array('choices' => array('facebook' => 'facebook', 'twitter' => 'twitter'))),
      'nombre'          => new sfWidgetFormInputText(),
      'descripcion'     => new sfWidgetFormInputText(),
      'url'             => new sfWidgetFormInputText(),
      'imagen'          => new sfWidgetFormInputText(),
      'mensaje'         => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'programado_para' => new sfValidatorDateTime(),
      'servicio'        => new sfValidatorChoice(array('choices' => array(0 => 'facebook', 1 => 'twitter'), 'required' => false)),
      'nombre'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descripcion'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'imagen'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mensaje'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('tdh_envio_social_pendiente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhEnvioSocialPendiente';
  }

}
