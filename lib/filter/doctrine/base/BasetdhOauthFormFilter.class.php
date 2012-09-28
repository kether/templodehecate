<?php

/**
 * tdhOauth filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhOauthFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'uid'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'servicio'     => new sfWidgetFormChoice(array('choices' => array('' => '', 'facebook' => 'facebook', 'twitter' => 'twitter', 'google' => 'google'))),
      'token'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'token_secret' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'usuario_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'uid'          => new sfValidatorPass(array('required' => false)),
      'servicio'     => new sfValidatorChoice(array('required' => false, 'choices' => array('facebook' => 'facebook', 'twitter' => 'twitter', 'google' => 'google'))),
      'token'        => new sfValidatorPass(array('required' => false)),
      'token_secret' => new sfValidatorPass(array('required' => false)),
      'usuario_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id')),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('tdh_oauth_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhOauth';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'uid'          => 'Text',
      'servicio'     => 'Enum',
      'token'        => 'Text',
      'token_secret' => 'Text',
      'usuario_id'   => 'ForeignKey',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
