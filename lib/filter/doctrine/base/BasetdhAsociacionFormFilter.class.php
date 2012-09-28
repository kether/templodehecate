<?php

/**
 * tdhAsociacion filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhAsociacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'num_socios'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'direccion'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'localidad'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'region'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pais'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'web'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'plazas_abiertas'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'acepta_invitaciones' => new sfWidgetFormChoice(array('choices' => array('' => '', 'no' => 'no', 'invitaciones' => 'invitaciones', 'abierto' => 'abierto'))),
      'tipo_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'                => new sfWidgetFormFilterInput(),
      'descripcion'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion_html'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'socios_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
    ));

    $this->setValidators(array(
      'nombre'              => new sfValidatorPass(array('required' => false)),
      'num_socios'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'direccion'           => new sfValidatorPass(array('required' => false)),
      'localidad'           => new sfValidatorPass(array('required' => false)),
      'region'              => new sfValidatorPass(array('required' => false)),
      'pais'                => new sfValidatorPass(array('required' => false)),
      'web'                 => new sfValidatorPass(array('required' => false)),
      'plazas_abiertas'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'acepta_invitaciones' => new sfValidatorChoice(array('required' => false, 'choices' => array('no' => 'no', 'invitaciones' => 'invitaciones', 'abierto' => 'abierto'))),
      'tipo_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'                => new sfValidatorPass(array('required' => false)),
      'descripcion'         => new sfValidatorPass(array('required' => false)),
      'descripcion_html'    => new sfValidatorPass(array('required' => false)),
      'socios_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_asociacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addSociosListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.tdhAsociacionUsuario tdhAsociacionUsuario')
      ->andWhereIn('tdhAsociacionUsuario.usuario_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'tdhAsociacion';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'nombre'              => 'Text',
      'num_socios'          => 'Number',
      'direccion'           => 'Text',
      'localidad'           => 'Text',
      'region'              => 'Text',
      'pais'                => 'Text',
      'web'                 => 'Text',
      'plazas_abiertas'     => 'Number',
      'acepta_invitaciones' => 'Enum',
      'tipo_id'             => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'slug'                => 'Text',
      'descripcion'         => 'Text',
      'descripcion_html'    => 'Text',
      'socios_list'         => 'ManyKey',
    );
  }
}
