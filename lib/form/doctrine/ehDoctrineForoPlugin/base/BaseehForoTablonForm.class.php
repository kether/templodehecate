<?php

/**
 * ehForoTablon form base class.
 *
 * @method ehForoTablon getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoTablonForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'estado_oculto'                 => new sfWidgetFormInputCheckbox(),
      'estado_restringido_hilos'      => new sfWidgetFormInputCheckbox(),
      'estado_restringido_respuestas' => new sfWidgetFormInputCheckbox(),
      'ordinal'                       => new sfWidgetFormInputText(),
      'nombre'                        => new sfWidgetFormInputText(),
      'descripcion'                   => new sfWidgetFormInputText(),
      'num_subtablones'               => new sfWidgetFormInputText(),
      'num_hilos'                     => new sfWidgetFormInputText(),
      'num_mensajes'                  => new sfWidgetFormInputText(),
      'uri_icon'                      => new sfWidgetFormInputText(),
      'ultimo_hilo_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UltimoHilo'), 'add_empty' => true)),
      'seccion_id'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'), 'add_empty' => false)),
      'tablon_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TablonPadre'), 'add_empty' => true)),
      'slug'                          => new sfWidgetFormInputText(),
      'visibles_list'                 => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
      'grupos_list'                   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehForoGrupo')),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_oculto'                 => new sfValidatorBoolean(array('required' => false)),
      'estado_restringido_hilos'      => new sfValidatorBoolean(array('required' => false)),
      'estado_restringido_respuestas' => new sfValidatorBoolean(array('required' => false)),
      'ordinal'                       => new sfValidatorInteger(array('required' => false)),
      'nombre'                        => new sfValidatorString(array('max_length' => 255)),
      'descripcion'                   => new sfValidatorString(array('max_length' => 255)),
      'num_subtablones'               => new sfValidatorInteger(array('required' => false)),
      'num_hilos'                     => new sfValidatorInteger(array('required' => false)),
      'num_mensajes'                  => new sfValidatorInteger(array('required' => false)),
      'uri_icon'                      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ultimo_hilo_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UltimoHilo'), 'required' => false)),
      'seccion_id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'))),
      'tablon_id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TablonPadre'), 'required' => false)),
      'slug'                          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'visibles_list'                 => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
      'grupos_list'                   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehForoGrupo', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ehForoTablon', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('eh_foro_tablon[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoTablon';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['visibles_list']))
    {
      $this->setDefault('visibles_list', $this->object->Visibles->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['grupos_list']))
    {
      $this->setDefault('grupos_list', $this->object->Grupos->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveVisiblesList($con);
    $this->saveGruposList($con);

    parent::doSave($con);
  }

  public function saveVisiblesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['visibles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Visibles->getPrimaryKeys();
    $values = $this->getValue('visibles_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Visibles', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Visibles', array_values($link));
    }
  }

  public function saveGruposList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['grupos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Grupos->getPrimaryKeys();
    $values = $this->getValue('grupos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Grupos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Grupos', array_values($link));
    }
  }

}
