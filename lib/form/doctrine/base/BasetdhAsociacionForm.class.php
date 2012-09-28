<?php

/**
 * tdhAsociacion form base class.
 *
 * @method tdhAsociacion getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhAsociacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'nombre'              => new sfWidgetFormInputText(),
      'num_socios'          => new sfWidgetFormInputText(),
      'direccion'           => new sfWidgetFormInputText(),
      'localidad'           => new sfWidgetFormInputText(),
      'region'              => new sfWidgetFormInputText(),
      'pais'                => new sfWidgetFormInputText(),
      'web'                 => new sfWidgetFormInputText(),
      'plazas_abiertas'     => new sfWidgetFormInputText(),
      'acepta_invitaciones' => new sfWidgetFormChoice(array('choices' => array('no' => 'no', 'invitaciones' => 'invitaciones', 'abierto' => 'abierto'))),
      'tipo_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'slug'                => new sfWidgetFormInputText(),
      'descripcion'         => new sfWidgetFormTextarea(),
      'descripcion_html'    => new sfWidgetFormTextarea(),
      'socios_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'num_socios'          => new sfValidatorInteger(array('required' => false)),
      'direccion'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'localidad'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'region'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pais'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'web'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'plazas_abiertas'     => new sfValidatorInteger(array('required' => false)),
      'acepta_invitaciones' => new sfValidatorChoice(array('choices' => array(0 => 'no', 1 => 'invitaciones', 2 => 'abierto'), 'required' => false)),
      'tipo_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'slug'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descripcion'         => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'descripcion_html'    => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'socios_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'tdhAsociacion', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('tdh_asociacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhAsociacion';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['socios_list']))
    {
      $this->setDefault('socios_list', $this->object->Socios->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveSociosList($con);

    parent::doSave($con);
  }

  public function saveSociosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['socios_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Socios->getPrimaryKeys();
    $values = $this->getValue('socios_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Socios', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Socios', array_values($link));
    }
  }

}
