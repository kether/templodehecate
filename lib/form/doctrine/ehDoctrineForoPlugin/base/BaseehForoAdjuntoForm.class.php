<?php

/**
 * ehForoAdjunto form base class.
 *
 * @method ehForoAdjunto getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoAdjuntoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'mensaje_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mensaje'), 'add_empty' => false)),
      'tipo_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'nombre'           => new sfWidgetFormInputText(),
      'nombre_fichero'   => new sfWidgetFormInputText(),
      'numero_descargas' => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mensaje_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mensaje'))),
      'tipo_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'nombre'           => new sfValidatorString(array('max_length' => 255)),
      'nombre_fichero'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'numero_descargas' => new sfValidatorInteger(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_adjunto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoAdjunto';
  }

}
