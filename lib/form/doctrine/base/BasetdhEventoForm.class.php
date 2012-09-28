<?php

/**
 * tdhEvento form base class.
 *
 * @method tdhEvento getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhEventoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'estado_aprobado' => new sfWidgetFormInputCheckbox(),
      'fecha_inicio'    => new sfWidgetFormDate(),
      'fecha_fin'       => new sfWidgetFormDate(),
      'direccion'       => new sfWidgetFormInputText(),
      'localidad'       => new sfWidgetFormInputText(),
      'region'          => new sfWidgetFormInputText(),
      'pais'            => new sfWidgetFormInputText(),
      'latitud'         => new sfWidgetFormInputText(),
      'longitud'        => new sfWidgetFormInputText(),
      'hilo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => false)),
      'apuntados_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_aprobado' => new sfValidatorBoolean(array('required' => false)),
      'fecha_inicio'    => new sfValidatorDate(),
      'fecha_fin'       => new sfValidatorDate(),
      'direccion'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'localidad'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'region'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pais'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'latitud'         => new sfValidatorNumber(array('required' => false)),
      'longitud'        => new sfValidatorNumber(array('required' => false)),
      'hilo_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'))),
      'apuntados_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_evento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhEvento';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['apuntados_list']))
    {
      $this->setDefault('apuntados_list', $this->object->Apuntados->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveApuntadosList($con);

    parent::doSave($con);
  }

  public function saveApuntadosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['apuntados_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Apuntados->getPrimaryKeys();
    $values = $this->getValue('apuntados_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Apuntados', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Apuntados', array_values($link));
    }
  }

}
