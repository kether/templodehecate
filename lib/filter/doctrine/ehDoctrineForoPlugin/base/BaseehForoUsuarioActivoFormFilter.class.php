<?php

/**
 * ehForoUsuarioActivo filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseehForoUsuarioActivoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'usuario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'modulo'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'accion'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'agent'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'usuario_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id')),
      'modulo'     => new sfValidatorPass(array('required' => false)),
      'accion'     => new sfValidatorPass(array('required' => false)),
      'agent'      => new sfValidatorPass(array('required' => false)),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_usuario_activo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoUsuarioActivo';
  }

  public function getFields()
  {
    return array(
      'ip'         => 'Text',
      'usuario_id' => 'ForeignKey',
      'modulo'     => 'Text',
      'accion'     => 'Text',
      'agent'      => 'Text',
      'updated_at' => 'Date',
    );
  }
}
