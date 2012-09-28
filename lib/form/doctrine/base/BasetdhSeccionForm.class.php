<?php

/**
 * tdhSeccion form base class.
 *
 * @method tdhSeccion getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhSeccionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'nombre'                    => new sfWidgetFormInputText(),
      'nombre_original'           => new sfWidgetFormInputText(),
      'estado_activa'             => new sfWidgetFormInputCheckbox(),
      'favoritos'                 => new sfWidgetFormInputText(),
      'url'                       => new sfWidgetFormInputText(),
      'genero_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Genero'), 'add_empty' => false)),
      'color_menu'                => new sfWidgetFormInputText(),
      'tipo_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'editor_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Editor'), 'add_empty' => false)),
      'tablon_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tablon'), 'add_empty' => false)),
      'created_at'                => new sfWidgetFormDateTime(),
      'updated_at'                => new sfWidgetFormDateTime(),
      'slug'                      => new sfWidgetFormInputText(),
      'descripcion'               => new sfWidgetFormTextarea(),
      'descripcion_html'          => new sfWidgetFormTextarea(),
      'favorita_de_usuarios_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
      'hojas_de_estilo_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhHojaDeEstilo')),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'                    => new sfValidatorString(array('max_length' => 255)),
      'nombre_original'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'estado_activa'             => new sfValidatorBoolean(array('required' => false)),
      'favoritos'                 => new sfValidatorInteger(array('required' => false)),
      'url'                       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'genero_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Genero'))),
      'color_menu'                => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'tipo_id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'editor_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Editor'))),
      'tablon_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tablon'))),
      'created_at'                => new sfValidatorDateTime(),
      'updated_at'                => new sfValidatorDateTime(),
      'slug'                      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descripcion'               => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'descripcion_html'          => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'favorita_de_usuarios_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
      'hojas_de_estilo_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhHojaDeEstilo', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'tdhSeccion', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('tdh_seccion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhSeccion';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['favorita_de_usuarios_list']))
    {
      $this->setDefault('favorita_de_usuarios_list', $this->object->FavoritaDeUsuarios->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['hojas_de_estilo_list']))
    {
      $this->setDefault('hojas_de_estilo_list', $this->object->HojasDeEstilo->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveFavoritaDeUsuariosList($con);
    $this->saveHojasDeEstiloList($con);

    parent::doSave($con);
  }

  public function saveFavoritaDeUsuariosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['favorita_de_usuarios_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->FavoritaDeUsuarios->getPrimaryKeys();
    $values = $this->getValue('favorita_de_usuarios_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('FavoritaDeUsuarios', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('FavoritaDeUsuarios', array_values($link));
    }
  }

  public function saveHojasDeEstiloList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['hojas_de_estilo_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->HojasDeEstilo->getPrimaryKeys();
    $values = $this->getValue('hojas_de_estilo_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('HojasDeEstilo', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('HojasDeEstilo', array_values($link));
    }
  }

}
