<?php

/**
 * tdhCritica form base class.
 *
 * @method tdhCritica getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhCriticaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'estado_aprobado'      => new sfWidgetFormInputCheckbox(),
      'estado_sin_nota'      => new sfWidgetFormInputCheckbox(),
      'estado_basico'        => new sfWidgetFormInputCheckbox(),
      'capturas_automaticas' => new sfWidgetFormInputCheckbox(),
      'fecha_publicacion'    => new sfWidgetFormDate(),
      'autor'                => new sfWidgetFormInputText(),
      'paginas'              => new sfWidgetFormInputText(),
      'idioma'               => new sfWidgetFormInputText(),
      'precio'               => new sfWidgetFormInputText(),
      'moneda'               => new sfWidgetFormInputText(),
      'nota'                 => new sfWidgetFormInputText(),
      'nota_media'           => new sfWidgetFormInputText(),
      'votos'                => new sfWidgetFormInputText(),
      'seccion_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'), 'add_empty' => false)),
      'editor_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Editor'), 'add_empty' => false)),
      'hilo_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_aprobado'      => new sfValidatorBoolean(array('required' => false)),
      'estado_sin_nota'      => new sfValidatorBoolean(array('required' => false)),
      'estado_basico'        => new sfValidatorBoolean(array('required' => false)),
      'capturas_automaticas' => new sfValidatorBoolean(array('required' => false)),
      'fecha_publicacion'    => new sfValidatorDate(array('required' => false)),
      'autor'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'paginas'              => new sfValidatorInteger(array('required' => false)),
      'idioma'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'precio'               => new sfValidatorNumber(array('required' => false)),
      'moneda'               => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'nota'                 => new sfValidatorNumber(array('required' => false)),
      'nota_media'           => new sfValidatorNumber(array('required' => false)),
      'votos'                => new sfValidatorInteger(array('required' => false)),
      'seccion_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'))),
      'editor_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Editor'))),
      'hilo_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'))),
    ));

    $this->widgetSchema->setNameFormat('tdh_critica[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhCritica';
  }

}
