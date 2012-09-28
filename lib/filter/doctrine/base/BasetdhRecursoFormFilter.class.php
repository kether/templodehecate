<?php

/**
 * tdhRecurso filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhRecursoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado_aprobado'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'acepta_donativos'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'favoritos'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'paypal'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'entradilla'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'autor'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contacto_autor'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'num_donativos'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad_donativos'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tiene_html'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'conver_pdf'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'conver_epub'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'separar_capitulos'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tipo_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'seccion_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seccion'), 'add_empty' => true)),
      'licencia_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Licencia'), 'add_empty' => true)),
      'hilo_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hilo'), 'add_empty' => true)),
      'favorito_de_usuarios_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser')),
    ));

    $this->setValidators(array(
      'estado_aprobado'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'acepta_donativos'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'favoritos'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paypal'                    => new sfValidatorPass(array('required' => false)),
      'entradilla'                => new sfValidatorPass(array('required' => false)),
      'autor'                     => new sfValidatorPass(array('required' => false)),
      'contacto_autor'            => new sfValidatorPass(array('required' => false)),
      'num_donativos'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidad_donativos'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tiene_html'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'conver_pdf'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'conver_epub'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'separar_capitulos'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tipo_id'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id')),
      'seccion_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seccion'), 'column' => 'id')),
      'licencia_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Licencia'), 'column' => 'id')),
      'hilo_id'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hilo'), 'column' => 'id')),
      'favorito_de_usuarios_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ehAuthUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tdh_recurso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addFavoritoDeUsuariosListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.tdhRecursoFavorito tdhRecursoFavorito')
      ->andWhereIn('tdhRecursoFavorito.usuario_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'tdhRecurso';
  }

  public function getFields()
  {
    return array(
      'id'                        => 'Number',
      'estado_aprobado'           => 'Boolean',
      'acepta_donativos'          => 'Boolean',
      'favoritos'                 => 'Number',
      'paypal'                    => 'Text',
      'entradilla'                => 'Text',
      'autor'                     => 'Text',
      'contacto_autor'            => 'Text',
      'num_donativos'             => 'Number',
      'cantidad_donativos'        => 'Number',
      'tiene_html'                => 'Boolean',
      'conver_pdf'                => 'Boolean',
      'conver_epub'               => 'Boolean',
      'separar_capitulos'         => 'Boolean',
      'tipo_id'                   => 'ForeignKey',
      'seccion_id'                => 'ForeignKey',
      'licencia_id'               => 'ForeignKey',
      'hilo_id'                   => 'ForeignKey',
      'favorito_de_usuarios_list' => 'ManyKey',
    );
  }
}
