<?php

/**
 * ehForoMensajePrivado filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseehForoMensajePrivadoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_leido'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_borrado_procedencia' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_borrado_destino'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_notificacion'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'mensaje_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mensaje'), 'add_empty' => true)),
      'usuario_destino_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'estado_leido'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_borrado_procedencia' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_borrado_destino'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_notificacion'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'mensaje_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mensaje'), 'column' => 'id')),
      'usuario_destino_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Destinatario'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_mensaje_privado_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoMensajePrivado';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'estado_leido'               => 'Boolean',
      'estado_borrado_procedencia' => 'Boolean',
      'estado_borrado_destino'     => 'Boolean',
      'estado_notificacion'        => 'Boolean',
      'mensaje_id'                 => 'ForeignKey',
      'usuario_destino_id'         => 'ForeignKey',
    );
  }
}
