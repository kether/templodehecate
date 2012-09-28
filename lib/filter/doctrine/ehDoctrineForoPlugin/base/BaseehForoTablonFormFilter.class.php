<?php

/**
 * ehForoTablon filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseehForoTablonFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_oculto'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_restringido_hilos'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_restringido_respuestas' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ordinal'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'num_subtablones'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'num_hilos'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'num_mensajes'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'uri_icon'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ultimo_hilo_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UltimoHilo'), 'add_empty' => true)),
      'seccion_id'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'), 'add_empty' => true)),
      'tablon_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TablonPadre'), 'add_empty' => true)),
      'slug'                          => new sfWidgetFormFilterInput(),
      'visibles_list'                 => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
      'grupos_list'                   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehForoGrupo')),
    ));

    $this->setValidators(array(
      'estado_oculto'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_restringido_hilos'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_restringido_respuestas' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ordinal'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'                        => new sfValidatorPass(array('required' => false)),
      'descripcion'                   => new sfValidatorPass(array('required' => false)),
      'num_subtablones'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'num_hilos'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'num_mensajes'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'uri_icon'                      => new sfValidatorPass(array('required' => false)),
      'ultimo_hilo_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UltimoHilo'), 'column' => 'id')),
      'seccion_id'                    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seccion'), 'column' => 'id')),
      'tablon_id'                     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TablonPadre'), 'column' => 'id')),
      'slug'                          => new sfValidatorPass(array('required' => false)),
      'visibles_list'                 => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
      'grupos_list'                   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehForoGrupo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_tablon_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addVisiblesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.ehForoVisible ehForoVisible')
      ->andWhereIn('ehForoVisible.usuario_id', $values)
    ;
  }

  public function addGruposListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.ehForoStaffTablon ehForoStaffTablon')
      ->andWhereIn('ehForoStaffTablon.grupo_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'ehForoTablon';
  }

  public function getFields()
  {
    return array(
      'id'                            => 'Number',
      'estado_oculto'                 => 'Boolean',
      'estado_restringido_hilos'      => 'Boolean',
      'estado_restringido_respuestas' => 'Boolean',
      'ordinal'                       => 'Number',
      'nombre'                        => 'Text',
      'descripcion'                   => 'Text',
      'num_subtablones'               => 'Number',
      'num_hilos'                     => 'Number',
      'num_mensajes'                  => 'Number',
      'uri_icon'                      => 'Text',
      'ultimo_hilo_id'                => 'ForeignKey',
      'seccion_id'                    => 'ForeignKey',
      'tablon_id'                     => 'ForeignKey',
      'slug'                          => 'Text',
      'visibles_list'                 => 'ManyKey',
      'grupos_list'                   => 'ManyKey',
    );
  }
}
