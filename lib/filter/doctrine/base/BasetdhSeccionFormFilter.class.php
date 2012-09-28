<?php

/**
 * tdhSeccion filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhSeccionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre_original'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'estado_activa'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'favoritos'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'genero_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Genero'), 'add_empty' => true)),
      'color_menu'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'editor_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Editor'), 'add_empty' => true)),
      'tablon_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tablon'), 'add_empty' => true)),
      'created_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'                      => new sfWidgetFormFilterInput(),
      'descripcion'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion_html'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'favorita_de_usuarios_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
      'hojas_de_estilo_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhHojaDeEstilo')),
    ));

    $this->setValidators(array(
      'nombre'                    => new sfValidatorPass(array('required' => false)),
      'nombre_original'           => new sfValidatorPass(array('required' => false)),
      'estado_activa'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'favoritos'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'url'                       => new sfValidatorPass(array('required' => false)),
      'genero_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Genero'), 'column' => 'id')),
      'color_menu'                => new sfValidatorPass(array('required' => false)),
      'tipo_id'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id')),
      'editor_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Editor'), 'column' => 'id')),
      'tablon_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tablon'), 'column' => 'id')),
      'created_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'                      => new sfValidatorPass(array('required' => false)),
      'descripcion'               => new sfValidatorPass(array('required' => false)),
      'descripcion_html'          => new sfValidatorPass(array('required' => false)),
      'favorita_de_usuarios_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
      'hojas_de_estilo_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhHojaDeEstilo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_seccion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addFavoritaDeUsuariosListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.tdhSeccionFavorita tdhSeccionFavorita')
      ->andWhereIn('tdhSeccionFavorita.usuario_id', $values)
    ;
  }

  public function addHojasDeEstiloListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.tdhSeccionEstilo tdhSeccionEstilo')
      ->andWhereIn('tdhSeccionEstilo.estilo_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'tdhSeccion';
  }

  public function getFields()
  {
    return array(
      'id'                        => 'Number',
      'nombre'                    => 'Text',
      'nombre_original'           => 'Text',
      'estado_activa'             => 'Boolean',
      'favoritos'                 => 'Number',
      'url'                       => 'Text',
      'genero_id'                 => 'ForeignKey',
      'color_menu'                => 'Text',
      'tipo_id'                   => 'ForeignKey',
      'editor_id'                 => 'ForeignKey',
      'tablon_id'                 => 'ForeignKey',
      'created_at'                => 'Date',
      'updated_at'                => 'Date',
      'slug'                      => 'Text',
      'descripcion'               => 'Text',
      'descripcion_html'          => 'Text',
      'favorita_de_usuarios_list' => 'ManyKey',
      'hojas_de_estilo_list'      => 'ManyKey',
    );
  }
}
