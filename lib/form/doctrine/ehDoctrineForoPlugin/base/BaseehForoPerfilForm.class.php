<?php

/**
 * ehForoPerfil form base class.
 *
 * @method ehForoPerfil getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseehForoPerfilForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'sexo'             => new sfWidgetFormChoice(array('choices' => array('Varón' => 'Varón', 'Mujer' => 'Mujer', 'Desconocido' => 'Desconocido'))),
      'fecha_nacimiento' => new sfWidgetFormDate(),
      'nick'             => new sfWidgetFormInputText(),
      'uri_avatar'       => new sfWidgetFormInputText(),
      'residencia'       => new sfWidgetFormInputText(),
      'email'            => new sfWidgetFormInputText(),
      'web'              => new sfWidgetFormInputText(),
      'notificaciones'   => new sfWidgetFormInputCheckbox(),
      'num_mensajes'     => new sfWidgetFormInputText(),
      'pais'             => new sfWidgetFormInputText(),
      'idioma'           => new sfWidgetFormInputText(),
      'zona_horaria'     => new sfWidgetFormInputText(),
      'firma'            => new sfWidgetFormTextarea(),
      'karma'            => new sfWidgetFormInputText(),
      'usuario_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'nombre'           => new sfWidgetFormInputText(),
      'apellidos'        => new sfWidgetFormInputText(),
      'pase_beta'        => new sfWidgetFormInputCheckbox(),
      'boletines'        => new sfWidgetFormInputCheckbox(),
      'sin_publi'        => new sfWidgetFormInputCheckbox(),
      'sin_publi_hasta'  => new sfWidgetFormDateTime(),
      'botones_sociales' => new sfWidgetFormInputCheckbox(),
      'foro_a_templo'    => new sfWidgetFormInputCheckbox(),
      'perfil_facebook'  => new sfWidgetFormInputText(),
      'perfil_twitter'   => new sfWidgetFormInputText(),
      'perfil_tuenti'    => new sfWidgetFormInputText(),
      'perfil_gplus'     => new sfWidgetFormInputText(),
      'perfil_paypal'    => new sfWidgetFormInputText(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'sexo'             => new sfValidatorChoice(array('choices' => array(0 => 'Varón', 1 => 'Mujer', 2 => 'Desconocido'), 'required' => false)),
      'fecha_nacimiento' => new sfValidatorDate(array('required' => false)),
      'nick'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'uri_avatar'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'residencia'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'            => new sfValidatorString(array('max_length' => 255)),
      'web'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'notificaciones'   => new sfValidatorBoolean(array('required' => false)),
      'num_mensajes'     => new sfValidatorInteger(array('required' => false)),
      'pais'             => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'idioma'           => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'zona_horaria'     => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'firma'            => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'karma'            => new sfValidatorInteger(array('required' => false)),
      'usuario_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'nombre'           => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'apellidos'        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'pase_beta'        => new sfValidatorBoolean(array('required' => false)),
      'boletines'        => new sfValidatorBoolean(array('required' => false)),
      'sin_publi'        => new sfValidatorBoolean(array('required' => false)),
      'sin_publi_hasta'  => new sfValidatorDateTime(),
      'botones_sociales' => new sfValidatorBoolean(array('required' => false)),
      'foro_a_templo'    => new sfValidatorBoolean(array('required' => false)),
      'perfil_facebook'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'perfil_twitter'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'perfil_tuenti'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'perfil_gplus'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'perfil_paypal'    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('eh_foro_perfil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ehForoPerfil';
  }

}
