<?php

/**
 * tdhSorteoParticipante filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhSorteoParticipanteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ip'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numero'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'token'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'domicilio'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comentario'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'facebook' => 'facebook', 'twitter' => 'twitter'))),
      'sorteo_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sorteo'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'usuario_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
    ));

    $this->setValidators(array(
      'ip'           => new sfValidatorPass(array('required' => false)),
      'numero'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'token'        => new sfValidatorPass(array('required' => false)),
      'email'        => new sfValidatorPass(array('required' => false)),
      'domicilio'    => new sfValidatorPass(array('required' => false)),
      'comentario'   => new sfValidatorPass(array('required' => false)),
      'tipo'         => new sfValidatorChoice(array('required' => false, 'choices' => array('facebook' => 'facebook', 'twitter' => 'twitter'))),
      'sorteo_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sorteo'), 'column' => 'id')),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'usuario_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_sorteo_participante_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addUsuarioListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.tdhSorteoUsuario tdhSorteoUsuario')
      ->andWhereIn('tdhSorteoUsuario.usuario_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'tdhSorteoParticipante';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'ip'           => 'Text',
      'numero'       => 'Number',
      'nombre'       => 'Text',
      'token'        => 'Text',
      'email'        => 'Text',
      'domicilio'    => 'Text',
      'comentario'   => 'Text',
      'tipo'         => 'Enum',
      'sorteo_id'    => 'ForeignKey',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
      'usuario_list' => 'ManyKey',
    );
  }
}
