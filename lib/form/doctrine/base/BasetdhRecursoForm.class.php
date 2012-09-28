<?php

/**
 * tdhRecurso form base class.
 *
 * @method tdhRecurso getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhRecursoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'estado_aprobado'           => new sfWidgetFormInputCheckbox(),
      'acepta_donativos'          => new sfWidgetFormInputCheckbox(),
      'favoritos'                 => new sfWidgetFormInputText(),
      'paypal'                    => new sfWidgetFormInputText(),
      'entradilla'                => new sfWidgetFormInputText(),
      'autor'                     => new sfWidgetFormInputText(),
      'contacto_autor'            => new sfWidgetFormInputText(),
      'num_donativos'             => new sfWidgetFormInputText(),
      'cantidad_donativos'        => new sfWidgetFormInputText(),
      'tiene_html'                => new sfWidgetFormInputCheckbox(),
      'conver_pdf'                => new sfWidgetFormInputCheckbox(),
      'conver_epub'               => new sfWidgetFormInputCheckbox(),
      'separar_capitulos'         => new sfWidgetFormInputCheckbox(),
      'tipo_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'seccion_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'), 'add_empty' => false)),
      'licencia_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Licencia'), 'add_empty' => false)),
      'hilo_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => false)),
      'favorito_de_usuarios_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estado_aprobado'           => new sfValidatorBoolean(array('required' => false)),
      'acepta_donativos'          => new sfValidatorBoolean(array('required' => false)),
      'favoritos'                 => new sfValidatorInteger(array('required' => false)),
      'paypal'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'entradilla'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'autor'                     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'contacto_autor'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'num_donativos'             => new sfValidatorInteger(array('required' => false)),
      'cantidad_donativos'        => new sfValidatorInteger(array('required' => false)),
      'tiene_html'                => new sfValidatorBoolean(array('required' => false)),
      'conver_pdf'                => new sfValidatorBoolean(array('required' => false)),
      'conver_epub'               => new sfValidatorBoolean(array('required' => false)),
      'separar_capitulos'         => new sfValidatorBoolean(array('required' => false)),
      'tipo_id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'seccion_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'))),
      'licencia_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Licencia'))),
      'hilo_id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'))),
      'favorito_de_usuarios_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_recurso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'tdhRecurso';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['favorito_de_usuarios_list']))
    {
      $this->setDefault('favorito_de_usuarios_list', $this->object->FavoritoDeUsuarios->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveFavoritoDeUsuariosList($con);

    parent::doSave($con);
  }

  public function saveFavoritoDeUsuariosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['favorito_de_usuarios_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->FavoritoDeUsuarios->getPrimaryKeys();
    $values = $this->getValue('favorito_de_usuarios_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('FavoritoDeUsuarios', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('FavoritoDeUsuarios', array_values($link));
    }
  }

}
