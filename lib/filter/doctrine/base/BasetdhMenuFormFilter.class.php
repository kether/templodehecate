<?php

/**
 * tdhMenu filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhMenuFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_portada' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'nombre'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ordinal'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'enlace'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'           => new sfWidgetFormFilterInput(),
      'menu_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('tdhMenu'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'estado_portada' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'nombre'         => new sfValidatorPass(array('required' => false)),
      'ordinal'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'descripcion'    => new sfValidatorPass(array('required' => false)),
      'enlace'         => new sfValidatorPass(array('required' => false)),
      'slug'           => new sfValidatorPass(array('required' => false)),
      'menu_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('tdhMenu'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tdh_menu_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhMenu';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'estado_portada' => 'Boolean',
      'nombre'         => 'Text',
      'ordinal'        => 'Number',
      'descripcion'    => 'Text',
      'enlace'         => 'Text',
      'slug'           => 'Text',
      'menu_id'        => 'ForeignKey',
    );
  }
}
