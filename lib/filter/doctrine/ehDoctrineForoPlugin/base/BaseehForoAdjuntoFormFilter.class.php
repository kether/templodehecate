<?php

/**
 * ehForoAdjunto filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseehForoAdjuntoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mensaje_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mensaje'), 'add_empty' => true)),
      'tipo_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'nombre'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre_fichero'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numero_descargas' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'mensaje_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mensaje'), 'column' => 'id')),
      'tipo_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id')),
      'nombre'           => new sfValidatorPass(array('required' => false)),
      'nombre_fichero'   => new sfValidatorPass(array('required' => false)),
      'numero_descargas' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_adjunto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoAdjunto';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'mensaje_id'       => 'ForeignKey',
      'tipo_id'          => 'ForeignKey',
      'nombre'           => 'Text',
      'nombre_fichero'   => 'Text',
      'numero_descargas' => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
