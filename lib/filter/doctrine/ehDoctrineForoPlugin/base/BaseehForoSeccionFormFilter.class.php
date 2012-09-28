<?php

/**
 * ehForoSeccion filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseehForoSeccionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_oculto' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ordinal'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'estado_oculto' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ordinal'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'        => new sfValidatorPass(array('required' => false)),
      'descripcion'   => new sfValidatorPass(array('required' => false)),
      'slug'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_seccion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoSeccion';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'estado_oculto' => 'Boolean',
      'ordinal'       => 'Number',
      'nombre'        => 'Text',
      'descripcion'   => 'Text',
      'slug'          => 'Text',
    );
  }
}
