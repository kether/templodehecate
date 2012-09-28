<?php

/**
 * ehForoHilo filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseehForoHiloFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_oculto'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_cerrado'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_staff'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_pinchado'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_general'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_seccion'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'leido'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'respuestas'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tablon_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tablon'), 'add_empty' => true)),
      'primer_mensaje_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PrimerMensaje'), 'add_empty' => true)),
      'ultimo_mensaje_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UltimoMensaje'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'estado_oculto'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_cerrado'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_staff'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_pinchado'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_general'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_seccion'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'leido'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuestas'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tablon_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tablon'), 'column' => 'id')),
      'primer_mensaje_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PrimerMensaje'), 'column' => 'id')),
      'ultimo_mensaje_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UltimoMensaje'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_hilo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoHilo';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'estado_oculto'     => 'Boolean',
      'estado_cerrado'    => 'Boolean',
      'estado_staff'      => 'Boolean',
      'estado_pinchado'   => 'Boolean',
      'estado_general'    => 'Boolean',
      'estado_seccion'    => 'Boolean',
      'leido'             => 'Number',
      'respuestas'        => 'Number',
      'tablon_id'         => 'ForeignKey',
      'primer_mensaje_id' => 'ForeignKey',
      'ultimo_mensaje_id' => 'ForeignKey',
    );
  }
}
