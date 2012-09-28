<?php

/**
 * tdhEnvioSocialPendiente filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhEnvioSocialPendienteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'programado_para' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'servicio'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'facebook' => 'facebook', 'twitter' => 'twitter'))),
      'nombre'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'imagen'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mensaje'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'programado_para' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'servicio'        => new sfValidatorChoice(array('required' => false, 'choices' => array('facebook' => 'facebook', 'twitter' => 'twitter'))),
      'nombre'          => new sfValidatorPass(array('required' => false)),
      'descripcion'     => new sfValidatorPass(array('required' => false)),
      'url'             => new sfValidatorPass(array('required' => false)),
      'imagen'          => new sfValidatorPass(array('required' => false)),
      'mensaje'         => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('tdh_envio_social_pendiente_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhEnvioSocialPendiente';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'programado_para' => 'Date',
      'servicio'        => 'Enum',
      'nombre'          => 'Text',
      'descripcion'     => 'Text',
      'url'             => 'Text',
      'imagen'          => 'Text',
      'mensaje'         => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
