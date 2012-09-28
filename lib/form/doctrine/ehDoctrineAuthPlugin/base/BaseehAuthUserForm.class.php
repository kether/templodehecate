<?php

/**
 * ehAuthUser form base class.
 *
 * @method ehAuthUser getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehAuthUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'username'                 => new sfWidgetFormInputText(),
      'salt'                     => new sfWidgetFormInputText(),
      'password'                 => new sfWidgetFormInputText(),
      'last_login'               => new sfWidgetFormDateTime(),
      'last_ip_address'          => new sfWidgetFormInputText(),
      'is_active'                => new sfWidgetFormInputCheckbox(),
      'is_super_admin'           => new sfWidgetFormInputCheckbox(),
      'remember_key'             => new sfWidgetFormInputText(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
      'credentials_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthCredential')),
      'visibles_tablones_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehForoTablon')),
      'grupos_list'              => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehForoGrupo')),
      'participante_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhSorteoParticipante')),
      'secciones_favoritas_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhSeccion')),
      'eventos_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhEvento')),
      'recursos_favoritos_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhRecurso')),
      'consulta_tipos_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhConsultaTipo')),
      'asociaciones_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'tdhAsociacion')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'username'                 => new sfValidatorString(array('max_length' => 128)),
      'salt'                     => new sfValidatorString(array('max_length' => 128)),
      'password'                 => new sfValidatorString(array('max_length' => 128)),
      'last_login'               => new sfValidatorDateTime(array('required' => false)),
      'last_ip_address'          => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'                => new sfValidatorBoolean(array('required' => false)),
      'is_super_admin'           => new sfValidatorBoolean(array('required' => false)),
      'remember_key'             => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
      'credentials_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthCredential', 'required' => false)),
      'visibles_tablones_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehForoTablon', 'required' => false)),
      'grupos_list'              => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehForoGrupo', 'required' => false)),
      'participante_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhSorteoParticipante', 'required' => false)),
      'secciones_favoritas_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhSeccion', 'required' => false)),
      'eventos_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhEvento', 'required' => false)),
      'recursos_favoritos_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhRecurso', 'required' => false)),
      'consulta_tipos_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhConsultaTipo', 'required' => false)),
      'asociaciones_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'tdhAsociacion', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ehAuthUser', 'column' => array('username')))
    );

    $this->widgetSchema->setNameFormat('eh_auth_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehAuthUser';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['credentials_list']))
    {
      $this->setDefault('credentials_list', $this->object->Credentials->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['visibles_tablones_list']))
    {
      $this->setDefault('visibles_tablones_list', $this->object->VisiblesTablones->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['grupos_list']))
    {
      $this->setDefault('grupos_list', $this->object->Grupos->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['participante_list']))
    {
      $this->setDefault('participante_list', $this->object->Participante->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['secciones_favoritas_list']))
    {
      $this->setDefault('secciones_favoritas_list', $this->object->SeccionesFavoritas->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['eventos_list']))
    {
      $this->setDefault('eventos_list', $this->object->Eventos->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['recursos_favoritos_list']))
    {
      $this->setDefault('recursos_favoritos_list', $this->object->RecursosFavoritos->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['consulta_tipos_list']))
    {
      $this->setDefault('consulta_tipos_list', $this->object->ConsultaTipos->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['asociaciones_list']))
    {
      $this->setDefault('asociaciones_list', $this->object->Asociaciones->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveCredentialsList($con);
    $this->saveVisiblesTablonesList($con);
    $this->saveGruposList($con);
    $this->saveParticipanteList($con);
    $this->saveSeccionesFavoritasList($con);
    $this->saveEventosList($con);
    $this->saveRecursosFavoritosList($con);
    $this->saveConsultaTiposList($con);
    $this->saveAsociacionesList($con);

    parent::doSave($con);
  }

  public function saveCredentialsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['credentials_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Credentials->getPrimaryKeys();
    $values = $this->getValue('credentials_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Credentials', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Credentials', array_values($link));
    }
  }

  public function saveVisiblesTablonesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['visibles_tablones_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->VisiblesTablones->getPrimaryKeys();
    $values = $this->getValue('visibles_tablones_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('VisiblesTablones', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('VisiblesTablones', array_values($link));
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

  public function saveParticipanteList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['participante_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Participante->getPrimaryKeys();
    $values = $this->getValue('participante_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Participante', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Participante', array_values($link));
    }
  }

  public function saveSeccionesFavoritasList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['secciones_favoritas_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->SeccionesFavoritas->getPrimaryKeys();
    $values = $this->getValue('secciones_favoritas_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('SeccionesFavoritas', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('SeccionesFavoritas', array_values($link));
    }
  }

  public function saveEventosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['eventos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Eventos->getPrimaryKeys();
    $values = $this->getValue('eventos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Eventos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Eventos', array_values($link));
    }
  }

  public function saveRecursosFavoritosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['recursos_favoritos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->RecursosFavoritos->getPrimaryKeys();
    $values = $this->getValue('recursos_favoritos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('RecursosFavoritos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('RecursosFavoritos', array_values($link));
    }
  }

  public function saveConsultaTiposList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['consulta_tipos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ConsultaTipos->getPrimaryKeys();
    $values = $this->getValue('consulta_tipos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ConsultaTipos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ConsultaTipos', array_values($link));
    }
  }

  public function saveAsociacionesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['asociaciones_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Asociaciones->getPrimaryKeys();
    $values = $this->getValue('asociaciones_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Asociaciones', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Asociaciones', array_values($link));
    }
  }

}
