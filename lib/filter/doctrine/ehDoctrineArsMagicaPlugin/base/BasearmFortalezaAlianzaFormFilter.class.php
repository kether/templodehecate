<?php

/**
 * armFortalezaAlianza filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasearmFortalezaAlianzaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tiene_mantenimiento' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'cantidad'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fortaleza_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fortalezas'), 'add_empty' => true)),
      'alianza_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alianza'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'tiene_mantenimiento' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'cantidad'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fortaleza_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fortalezas'), 'column' => 'id')),
      'alianza_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Alianza'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('arm_fortaleza_alianza_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'armFortalezaAlianza';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'tiene_mantenimiento' => 'Boolean',
      'cantidad'            => 'Number',
      'fortaleza_id'        => 'ForeignKey',
      'alianza_id'          => 'ForeignKey',
    );
  }
}
