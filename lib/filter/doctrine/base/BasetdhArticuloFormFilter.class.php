<?php

/**
 * tdhArticulo filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhArticuloFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'es_aprobado' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tipo'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'miscelanea' => 'miscelanea', 'pie' => 'pie', 'cabecera' => 'cabecera'))),
      'hilo_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'es_aprobado' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tipo'        => new sfValidatorChoice(array('required' => false, 'choices' => array('miscelanea' => 'miscelanea', 'pie' => 'pie', 'cabecera' => 'cabecera'))),
      'hilo_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hilo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tdh_articulo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhArticulo';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'es_aprobado' => 'Boolean',
      'tipo'        => 'Enum',
      'hilo_id'     => 'ForeignKey',
    );
  }
}
