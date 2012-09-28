<?php

/**
 * ehForoAdjuntoTipo filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseehForoAdjuntoTipoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dir'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre' => new sfValidatorPass(array('required' => false)),
      'url'    => new sfValidatorPass(array('required' => false)),
      'dir'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_adjunto_tipo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoAdjuntoTipo';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'nombre' => 'Text',
      'url'    => 'Text',
      'dir'    => 'Text',
    );
  }
}
