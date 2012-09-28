<?php

/**
 * ehForoGrupo form base class.
 *
 * @method ehForoGrupo getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoGrupoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'nombre'           => new sfWidgetFormInputText(),
      'es_restringido'   => new sfWidgetFormInputCheckbox(),
      'slug'             => new sfWidgetFormInputText(),
      'descripcion'      => new sfWidgetFormTextarea(),
      'descripcion_html' => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'usuarios_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
      'tablones_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehForoTablon')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'           => new sfValidatorString(array('max_length' => 255)),
      'es_restringido'   => new sfValidatorBoolean(array('required' => false)),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descripcion'      => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'descripcion_html' => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'usuarios_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
      'tablones_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehForoTablon', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ehForoGrupo', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('eh_foro_grupo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoGrupo';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['usuarios_list']))
    {
      $this->setDefault('usuarios_list', $this->object->Usuarios->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['tablones_list']))
    {
      $this->setDefault('tablones_list', $this->object->Tablones->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveUsuariosList($con);
    $this->saveTablonesList($con);

    parent::doSave($con);
  }

  public function saveUsuariosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['usuarios_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Usuarios->getPrimaryKeys();
    $values = $this->getValue('usuarios_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Usuarios', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Usuarios', array_values($link));
    }
  }

  public function saveTablonesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tablones_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Tablones->getPrimaryKeys();
    $values = $this->getValue('tablones_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Tablones', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Tablones', array_values($link));
    }
  }

}
