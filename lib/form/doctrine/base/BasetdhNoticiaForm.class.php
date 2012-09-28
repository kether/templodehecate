<?php

/**
 * tdhNoticia form base class.
 *
 * @method tdhNoticia getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhNoticiaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'estado_aprobado' => new sfWidgetFormInputCheckbox(),
      'es_destacada'    => new sfWidgetFormInputCheckbox(),
      'entradilla'      => new sfWidgetFormInputText(),
      'nombre_fuente'   => new sfWidgetFormInputText(),
      'url_fuente'      => new sfWidgetFormInputText(),
      'seccion_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'), 'add_empty' => false)),
      'hilo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_aprobado' => new sfValidatorBoolean(array('required' => false)),
      'es_destacada'    => new sfValidatorBoolean(array('required' => false)),
      'entradilla'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nombre_fuente'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url_fuente'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'seccion_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'))),
      'hilo_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'))),
    ));

    $this->widgetSchema->setNameFormat('tdh_noticia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhNoticia';
  }

}
