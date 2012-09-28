<?php

/**
 * tdhNoticia form.
 *
 * @package    form
 * @subpackage tdhNoticia
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhNoticiaForm extends BasetdhNoticiaForm
{  
  public function configure()
  {
    $this->useFields(array(
      'estado_aprobado',
      'es_destacada',
      'entradilla',
      'nombre_fuente',
      'url_fuente',
      'seccion_id'
    ));
    
    $this->setWidget('seccion_id', new sfWidgetFormChoice(array('choices' => Doctrine::getTable('tdhSeccion')->retrieveArrayFormList())));
    
    $this->getWidgetSchema()->setLabels(array(
      'estado_aprobado'   => '¿Aprobado?',
      'es_destacada'      => '¿Destacada?',
      'nombre_fuente'     => 'Fuente',
      'url_fuente'        => 'URL',
      'seccion_id'        => 'Sección'
    ));
    
    if(!$this->isNew())
    {
      unset($this['seccion_id']);
    }
  }
}