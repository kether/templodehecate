<?php

/**
 * tdhAnuncio filter form.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhAnuncioFormFilter extends BasetdhAnuncioFormFilter
{
  public function configure()
  {
    $this->useFields(array(
    	'activo',
    	'nombre',
    	'url',
    	'temporal',
    	'es_flash',
    	'es_codigo',
    	'tipo_id'
    ));
    
    $this->setValidator('url', new sfValidatorUrl(array('required' => true)));
    
    $this->getWidgetSchema()->setLabels(array(
      'url' => 'URL',
      'temporal' => '¿Temporal?',
      'es_flash' => '¿Flash?',
      'es_codigo' => '¿Código HTML?'
    ));
  }
}
