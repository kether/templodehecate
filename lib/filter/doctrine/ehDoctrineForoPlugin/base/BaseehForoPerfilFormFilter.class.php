<?php

/**
 * ehForoPerfil filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseehForoPerfilFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sexo'             => new sfWidgetFormChoice(array('choices' => array('' => '', 'Varón' => 'Varón', 'Mujer' => 'Mujer', 'Desconocido' => 'Desconocido'))),
      'fecha_nacimiento' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nick'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'uri_avatar'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'residencia'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'web'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'notificaciones'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'num_mensajes'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pais'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idioma'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'zona_horaria'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'firma'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'karma'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'usuario_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'nombre'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellidos'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pase_beta'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'boletines'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'sin_publi'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'sin_publi_hasta'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'botones_sociales' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'foro_a_templo'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'perfil_facebook'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'perfil_twitter'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'perfil_tuenti'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'perfil_gplus'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'perfil_paypal'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'sexo'             => new sfValidatorChoice(array('required' => false, 'choices' => array('Varón' => 'Varón', 'Mujer' => 'Mujer', 'Desconocido' => 'Desconocido'))),
      'fecha_nacimiento' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nick'             => new sfValidatorPass(array('required' => false)),
      'uri_avatar'       => new sfValidatorPass(array('required' => false)),
      'residencia'       => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'web'              => new sfValidatorPass(array('required' => false)),
      'notificaciones'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'num_mensajes'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pais'             => new sfValidatorPass(array('required' => false)),
      'idioma'           => new sfValidatorPass(array('required' => false)),
      'zona_horaria'     => new sfValidatorPass(array('required' => false)),
      'firma'            => new sfValidatorPass(array('required' => false)),
      'karma'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'usuario_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id')),
      'nombre'           => new sfValidatorPass(array('required' => false)),
      'apellidos'        => new sfValidatorPass(array('required' => false)),
      'pase_beta'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'boletines'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'sin_publi'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'sin_publi_hasta'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'botones_sociales' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'foro_a_templo'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'perfil_facebook'  => new sfValidatorPass(array('required' => false)),
      'perfil_twitter'   => new sfValidatorPass(array('required' => false)),
      'perfil_tuenti'    => new sfValidatorPass(array('required' => false)),
      'perfil_gplus'     => new sfValidatorPass(array('required' => false)),
      'perfil_paypal'    => new sfValidatorPass(array('required' => false)),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_perfil_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoPerfil';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'sexo'             => 'Enum',
      'fecha_nacimiento' => 'Date',
      'nick'             => 'Text',
      'uri_avatar'       => 'Text',
      'residencia'       => 'Text',
      'email'            => 'Text',
      'web'              => 'Text',
      'notificaciones'   => 'Boolean',
      'num_mensajes'     => 'Number',
      'pais'             => 'Text',
      'idioma'           => 'Text',
      'zona_horaria'     => 'Text',
      'firma'            => 'Text',
      'karma'            => 'Number',
      'usuario_id'       => 'ForeignKey',
      'nombre'           => 'Text',
      'apellidos'        => 'Text',
      'pase_beta'        => 'Boolean',
      'boletines'        => 'Boolean',
      'sin_publi'        => 'Boolean',
      'sin_publi_hasta'  => 'Date',
      'botones_sociales' => 'Boolean',
      'foro_a_templo'    => 'Boolean',
      'perfil_facebook'  => 'Text',
      'perfil_twitter'   => 'Text',
      'perfil_tuenti'    => 'Text',
      'perfil_gplus'     => 'Text',
      'perfil_paypal'    => 'Text',
      'updated_at'       => 'Date',
    );
  }
}
