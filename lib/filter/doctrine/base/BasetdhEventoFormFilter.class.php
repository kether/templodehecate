<?php

/**
 * tdhEvento filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhEventoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_aprobado' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fecha_inicio'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_fin'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'direccion'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'localidad'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'region'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pais'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'latitud'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'longitud'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'hilo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => true)),
      'apuntados_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
    ));

    $this->setValidators(array(
      'estado_aprobado' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fecha_inicio'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_fin'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'direccion'       => new sfValidatorPass(array('required' => false)),
      'localidad'       => new sfValidatorPass(array('required' => false)),
      'region'          => new sfValidatorPass(array('required' => false)),
      'pais'            => new sfValidatorPass(array('required' => false)),
      'latitud'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'longitud'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'hilo_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hilo'), 'column' => 'id')),
      'apuntados_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_evento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addApuntadosListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.tdhEventoApuntado tdhEventoApuntado')
      ->andWhereIn('tdhEventoApuntado.usuario_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'tdhEvento';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'estado_aprobado' => 'Boolean',
      'fecha_inicio'    => 'Date',
      'fecha_fin'       => 'Date',
      'direccion'       => 'Text',
      'localidad'       => 'Text',
      'region'          => 'Text',
      'pais'            => 'Text',
      'latitud'         => 'Number',
      'longitud'        => 'Number',
      'hilo_id'         => 'ForeignKey',
      'apuntados_list'  => 'ManyKey',
    );
  }
}
