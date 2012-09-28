<?php

/**
 * ehForoHilo form base class.
 *
 * @method ehForoHilo getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoHiloForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'estado_oculto'     => new sfWidgetFormInputCheckbox(),
      'estado_cerrado'    => new sfWidgetFormInputCheckbox(),
      'estado_staff'      => new sfWidgetFormInputCheckbox(),
      'estado_pinchado'   => new sfWidgetFormInputCheckbox(),
      'estado_general'    => new sfWidgetFormInputCheckbox(),
      'estado_seccion'    => new sfWidgetFormInputCheckbox(),
      'leido'             => new sfWidgetFormInputText(),
      'respuestas'        => new sfWidgetFormInputText(),
      'tablon_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tablon'), 'add_empty' => false)),
      'primer_mensaje_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PrimerMensaje'), 'add_empty' => true)),
      'ultimo_mensaje_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UltimoMensaje'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_oculto'     => new sfValidatorBoolean(array('required' => false)),
      'estado_cerrado'    => new sfValidatorBoolean(array('required' => false)),
      'estado_staff'      => new sfValidatorBoolean(array('required' => false)),
      'estado_pinchado'   => new sfValidatorBoolean(array('required' => false)),
      'estado_general'    => new sfValidatorBoolean(array('required' => false)),
      'estado_seccion'    => new sfValidatorBoolean(array('required' => false)),
      'leido'             => new sfValidatorInteger(array('required' => false)),
      'respuestas'        => new sfValidatorInteger(array('required' => false)),
      'tablon_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tablon'))),
      'primer_mensaje_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PrimerMensaje'), 'required' => false)),
      'ultimo_mensaje_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UltimoMensaje'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_hilo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoHilo';
  }

}
