<?php

/**
 * tdhSorteoParticipante form base class.
 *
 * @method tdhSorteoParticipante getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhSorteoParticipanteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'ip'           => new sfWidgetFormInputText(),
      'numero'       => new sfWidgetFormInputText(),
      'nombre'       => new sfWidgetFormInputText(),
      'token'        => new sfWidgetFormInputText(),
      'email'        => new sfWidgetFormInputText(),
      'domicilio'    => new sfWidgetFormInputText(),
      'comentario'   => new sfWidgetFormInputText(),
      'tipo'         => new sfWidgetFormChoice(array('choices' => array('facebook' => 'facebook', 'twitter' => 'twitter'))),
      'sorteo_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sorteo'), 'add_empty' => false)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'usuario_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'ip'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'numero'       => new sfValidatorInteger(array('required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'token'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'domicilio'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'comentario'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tipo'         => new sfValidatorChoice(array('choices' => array(0 => 'facebook', 1 => 'twitter'), 'required' => false)),
      'sorteo_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sorteo'))),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'usuario_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'tdhSorteoParticipante', 'column' => array('email', 'sorteo_id', 'token')))
    );

    $this->widgetSchema->setNameFormat('tdh_sorteo_participante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhSorteoParticipante';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['usuario_list']))
    {
      $this->setDefault('usuario_list', $this->object->Usuario->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveUsuarioList($con);

    parent::doSave($con);
  }

  public function saveUsuarioList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['usuario_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Usuario->getPrimaryKeys();
    $values = $this->getValue('usuario_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Usuario', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Usuario', array_values($link));
    }
  }

}
