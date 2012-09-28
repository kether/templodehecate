<?php

/**
 * tdhCriticaVideo filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhCriticaVideoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'comentario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'medio'      => new sfWidgetFormChoice(array('choices' => array('' => '', 'Youtube' => 'Youtube', 'Dailymotion' => 'Dailymotion'))),
      'url'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'critica_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Critica'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'comentario' => new sfValidatorPass(array('required' => false)),
      'medio'      => new sfValidatorChoice(array('required' => false, 'choices' => array('Youtube' => 'Youtube', 'Dailymotion' => 'Dailymotion'))),
      'url'        => new sfValidatorPass(array('required' => false)),
      'critica_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Critica'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tdh_critica_video_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhCriticaVideo';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'comentario' => 'Text',
      'medio'      => 'Enum',
      'url'        => 'Text',
      'critica_id' => 'ForeignKey',
    );
  }
}
