<?php

/**
 * tdhHojaDeEstilo form base class.
 *
 * @method tdhHojaDeEstilo getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhHojaDeEstiloForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'title'          => new sfWidgetFormInputText(),
      'filename'       => new sfWidgetFormInputText(),
      'media'          => new sfWidgetFormInputText(),
      'content'        => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'secciones_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhSeccion')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255)),
      'filename'       => new sfValidatorString(array('max_length' => 255)),
      'media'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'content'        => new sfValidatorString(array('max_length' => 1000)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'secciones_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhSeccion', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_hoja_de_estilo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhHojaDeEstilo';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['secciones_list']))
    {
      $this->setDefault('secciones_list', $this->object->Secciones->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveSeccionesList($con);

    parent::doSave($con);
  }

  public function saveSeccionesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['secciones_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Secciones->getPrimaryKeys();
    $values = $this->getValue('secciones_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Secciones', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Secciones', array_values($link));
    }
  }

}
