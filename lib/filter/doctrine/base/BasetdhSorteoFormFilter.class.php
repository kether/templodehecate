<?php

/**
 * tdhSorteo filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhSorteoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_visible'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_abierto'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'nombre'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'entradilla'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'aclaraciones'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mensaje'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'desde'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hasta'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'sufijo'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'semilla'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'participantes_min' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'participantes_max' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'participantes_num' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion_html'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'estado_visible'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_abierto'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'nombre'            => new sfValidatorPass(array('required' => false)),
      'entradilla'        => new sfValidatorPass(array('required' => false)),
      'aclaraciones'      => new sfValidatorPass(array('required' => false)),
      'mensaje'           => new sfValidatorPass(array('required' => false)),
      'desde'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'hasta'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'sufijo'            => new sfValidatorPass(array('required' => false)),
      'url'               => new sfValidatorPass(array('required' => false)),
      'semilla'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'participantes_min' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'participantes_max' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'participantes_num' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'descripcion'       => new sfValidatorPass(array('required' => false)),
      'descripcion_html'  => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'              => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_sorteo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhSorteo';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'estado_visible'    => 'Boolean',
      'estado_abierto'    => 'Boolean',
      'nombre'            => 'Text',
      'entradilla'        => 'Text',
      'aclaraciones'      => 'Text',
      'mensaje'           => 'Text',
      'desde'             => 'Date',
      'hasta'             => 'Date',
      'sufijo'            => 'Text',
      'url'               => 'Text',
      'semilla'           => 'Number',
      'participantes_min' => 'Number',
      'participantes_max' => 'Number',
      'participantes_num' => 'Number',
      'descripcion'       => 'Text',
      'descripcion_html'  => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'slug'              => 'Text',
    );
  }
}
