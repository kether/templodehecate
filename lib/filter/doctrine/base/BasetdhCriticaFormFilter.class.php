<?php

/**
 * tdhCritica filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhCriticaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_aprobado'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_sin_nota'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estado_basico'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'capturas_automaticas' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fecha_publicacion'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'autor'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'paginas'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idioma'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'precio'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'moneda'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nota'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nota_media'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'votos'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'seccion_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'), 'add_empty' => true)),
      'editor_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Editor'), 'add_empty' => true)),
      'hilo_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'estado_aprobado'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_sin_nota'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estado_basico'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'capturas_automaticas' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fecha_publicacion'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'autor'                => new sfValidatorPass(array('required' => false)),
      'paginas'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idioma'               => new sfValidatorPass(array('required' => false)),
      'precio'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'moneda'               => new sfValidatorPass(array('required' => false)),
      'nota'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'nota_media'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'votos'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'seccion_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seccion'), 'column' => 'id')),
      'editor_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Editor'), 'column' => 'id')),
      'hilo_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hilo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tdh_critica_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhCritica';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'estado_aprobado'      => 'Boolean',
      'estado_sin_nota'      => 'Boolean',
      'estado_basico'        => 'Boolean',
      'capturas_automaticas' => 'Boolean',
      'fecha_publicacion'    => 'Date',
      'autor'                => 'Text',
      'paginas'              => 'Number',
      'idioma'               => 'Text',
      'precio'               => 'Number',
      'moneda'               => 'Text',
      'nota'                 => 'Number',
      'nota_media'           => 'Number',
      'votos'                => 'Number',
      'seccion_id'           => 'ForeignKey',
      'editor_id'            => 'ForeignKey',
      'hilo_id'              => 'ForeignKey',
    );
  }
}
