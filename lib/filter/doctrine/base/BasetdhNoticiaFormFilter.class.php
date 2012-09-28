<?php

/**
 * tdhNoticia filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhNoticiaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_aprobado' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'es_destacada'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'entradilla'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre_fuente'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url_fuente'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'seccion_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'), 'add_empty' => true)),
      'hilo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'estado_aprobado' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'es_destacada'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'entradilla'      => new sfValidatorPass(array('required' => false)),
      'nombre_fuente'   => new sfValidatorPass(array('required' => false)),
      'url_fuente'      => new sfValidatorPass(array('required' => false)),
      'seccion_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seccion'), 'column' => 'id')),
      'hilo_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hilo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tdh_noticia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhNoticia';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'estado_aprobado' => 'Boolean',
      'es_destacada'    => 'Boolean',
      'entradilla'      => 'Text',
      'nombre_fuente'   => 'Text',
      'url_fuente'      => 'Text',
      'seccion_id'      => 'ForeignKey',
      'hilo_id'         => 'ForeignKey',
    );
  }
}
