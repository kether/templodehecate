<?php

/**
 * ehForoMensajePrivado form base class.
 *
 * @method ehForoMensajePrivado getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoMensajePrivadoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'estado_leido'               => new sfWidgetFormInputCheckbox(),
      'estado_borrado_procedencia' => new sfWidgetFormInputCheckbox(),
      'estado_borrado_destino'     => new sfWidgetFormInputCheckbox(),
      'estado_notificacion'        => new sfWidgetFormInputCheckbox(),
      'mensaje_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mensaje'), 'add_empty' => true)),
      'usuario_destino_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatario'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_leido'               => new sfValidatorBoolean(array('required' => false)),
      'estado_borrado_procedencia' => new sfValidatorBoolean(array('required' => false)),
      'estado_borrado_destino'     => new sfValidatorBoolean(array('required' => false)),
      'estado_notificacion'        => new sfValidatorBoolean(array('required' => false)),
      'mensaje_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mensaje'), 'required' => false)),
      'usuario_destino_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatario'))),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_mensaje_privado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoMensajePrivado';
  }

}
