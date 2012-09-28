<?php

/**
 * ehAuthUser filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseehAuthUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'salt'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_login'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'last_ip_address'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_super_admin'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'remember_key'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'credentials_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthCredential')),
      'visibles_tablones_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehForoTablon')),
      'grupos_list'              => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehForoGrupo')),
      'participante_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhSorteoParticipante')),
      'secciones_favoritas_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhSeccion')),
      'eventos_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhEvento')),
      'recursos_favoritos_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhRecurso')),
      'consulta_tipos_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhConsultaTipo')),
      'asociaciones_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhAsociacion')),
    ));

    $this->setValidators(array(
      'username'                 => new sfValidatorPass(array('required' => false)),
      'salt'                     => new sfValidatorPass(array('required' => false)),
      'password'                 => new sfValidatorPass(array('required' => false)),
      'last_login'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'last_ip_address'          => new sfValidatorPass(array('required' => false)),
      'is_active'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_super_admin'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'remember_key'             => new sfValidatorPass(array('required' => false)),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'credentials_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthCredential', 'required' => false)),
      'visibles_tablones_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehForoTablon', 'required' => false)),
      'grupos_list'              => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehForoGrupo', 'required' => false)),
      'participante_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhSorteoParticipante', 'required' => false)),
      'secciones_favoritas_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhSeccion', 'required' => false)),
      'eventos_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhEvento', 'required' => false)),
      'recursos_favoritos_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhRecurso', 'required' => false)),
      'consulta_tipos_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhConsultaTipo', 'required' => false)),
      'asociaciones_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhAsociacion', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('eh_auth_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addCredentialsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.ehAuthCredentialUser ehAuthCredentialUser')
      ->andWhereIn('ehAuthCredentialUser.credential_id', $values)
    ;
  }

  public function addVisiblesTablonesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('ehForoVisible.foro_id', $values)
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
      ->leftJoin($query->getRootAlias().'.ehForoGrupoUsuario ehForoGrupoUsuario')
      ->andWhereIn('ehForoGrupoUsuario.grupo_id', $values)
    ;
  }

  public function addParticipanteListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('tdhSorteoUsuario.participante_id', $values)
    ;
  }

  public function addSeccionesFavoritasListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('tdhSeccionFavorita.seccion_id', $values)
    ;
  }

  public function addEventosListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('tdhEventoApuntado.evento_id', $values)
    ;
  }

  public function addRecursosFavoritosListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.tdhRecursoFavorito tdhRecursoFavorito')
      ->andWhereIn('tdhRecursoFavorito.recurso_id', $values)
    ;
  }

  public function addConsultaTiposListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.tdhConsultaTipoUsuario tdhConsultaTipoUsuario')
      ->andWhereIn('tdhConsultaTipoUsuario.tipo_id', $values)
    ;
  }

  public function addAsociacionesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('tdhAsociacionUsuario.asociacion_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'ehAuthUser';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'username'                 => 'Text',
      'salt'                     => 'Text',
      'password'                 => 'Text',
      'last_login'               => 'Date',
      'last_ip_address'          => 'Text',
      'is_active'                => 'Boolean',
      'is_super_admin'           => 'Boolean',
      'remember_key'             => 'Text',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'credentials_list'         => 'ManyKey',
      'visibles_tablones_list'   => 'ManyKey',
      'grupos_list'              => 'ManyKey',
      'participante_list'        => 'ManyKey',
      'secciones_favoritas_list' => 'ManyKey',
      'eventos_list'             => 'ManyKey',
      'recursos_favoritos_list'  => 'ManyKey',
      'consulta_tipos_list'      => 'ManyKey',
      'asociaciones_list'        => 'ManyKey',
    );
  }
}
