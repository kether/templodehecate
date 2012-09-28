<?php

/**
 * tdhSorteoCondicion filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhSorteoCondicionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'propietario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'facebook' => 'facebook', 'twitter' => 'twitter'))),
      'sorteo_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sorteo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'      => new sfValidatorPass(array('required' => false)),
      'url'         => new sfValidatorPass(array('required' => false)),
      'propietario' => new sfValidatorPass(array('required' => false)),
      'tipo'        => new sfValidatorChoice(array('required' => false, 'choices' => array('facebook' => 'facebook', 'twitter' => 'twitter'))),
      'sorteo_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sorteo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tdh_sorteo_condicion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhSorteoCondicion';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'nombre'      => 'Text',
      'url'         => 'Text',
      'propietario' => 'Text',
      'tipo'        => 'Enum',
      'sorteo_id'   => 'ForeignKey',
    );
  }
}
