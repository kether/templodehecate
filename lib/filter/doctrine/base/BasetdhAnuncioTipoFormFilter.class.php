<?php

/**
 * tdhAnuncioTipo filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhAnuncioTipoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'anchura'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'altura'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'multiple'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'rotativo'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'codigo_alternativo' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'               => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nombre'             => new sfValidatorPass(array('required' => false)),
      'anchura'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'altura'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'multiple'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'rotativo'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'codigo_alternativo' => new sfValidatorPass(array('required' => false)),
      'slug'               => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_anuncio_tipo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhAnuncioTipo';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'nombre'             => 'Text',
      'anchura'            => 'Number',
      'altura'             => 'Number',
      'multiple'           => 'Boolean',
      'rotativo'           => 'Boolean',
      'codigo_alternativo' => 'Text',
      'slug'               => 'Text',
    );
  }
}
