<?php

/**
 * ehForoMensaje filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseehForoMensajeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_activo'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tiene_adjuntos'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_staff'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'nombre_invitado' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'asunto'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'html'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'bbcode'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'nl2br'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'emoticonos'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'markdown'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'firma'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'karma'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'visible_desde'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hilo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => true)),
      'usuario_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'            => new sfWidgetFormFilterInput(),
      'cuerpo'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cuerpo_html'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'estado_activo'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tiene_adjuntos'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_staff'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'nombre_invitado' => new sfValidatorPass(array('required' => false)),
      'ip'              => new sfValidatorPass(array('required' => false)),
      'asunto'          => new sfValidatorPass(array('required' => false)),
      'html'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'bbcode'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'nl2br'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'emoticonos'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'markdown'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'firma'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'karma'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'visible_desde'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'hilo_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hilo'), 'column' => 'id')),
      'usuario_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id')),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'            => new sfValidatorPass(array('required' => false)),
      'cuerpo'          => new sfValidatorPass(array('required' => false)),
      'cuerpo_html'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_mensaje_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoMensaje';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'estado_activo'   => 'Boolean',
      'tiene_adjuntos'  => 'Boolean',
      'estado_staff'    => 'Boolean',
      'nombre_invitado' => 'Text',
      'ip'              => 'Text',
      'asunto'          => 'Text',
      'html'            => 'Boolean',
      'bbcode'          => 'Boolean',
      'nl2br'           => 'Boolean',
      'emoticonos'      => 'Boolean',
      'markdown'        => 'Boolean',
      'firma'           => 'Boolean',
      'karma'           => 'Number',
      'visible_desde'   => 'Date',
      'hilo_id'         => 'ForeignKey',
      'usuario_id'      => 'ForeignKey',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'slug'            => 'Text',
      'cuerpo'          => 'Text',
      'cuerpo_html'     => 'Text',
    );
  }
}
