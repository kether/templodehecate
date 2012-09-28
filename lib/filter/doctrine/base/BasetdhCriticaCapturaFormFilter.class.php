<?php

/**
 * tdhCriticaCaptura filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhCriticaCapturaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'comentario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tam_peq'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tam_med'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tam_gra'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'critica_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Critica'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'comentario' => new sfValidatorPass(array('required' => false)),
      'fichero'    => new sfValidatorPass(array('required' => false)),
      'tam_peq'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tam_med'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tam_gra'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'critica_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Critica'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tdh_critica_captura_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhCriticaCaptura';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'comentario' => 'Text',
      'fichero'    => 'Text',
      'tam_peq'    => 'Boolean',
      'tam_med'    => 'Boolean',
      'tam_gra'    => 'Boolean',
      'critica_id' => 'ForeignKey',
    );
  }
}
