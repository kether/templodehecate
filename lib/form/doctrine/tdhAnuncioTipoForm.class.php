<?php

/**
 * tdhAnuncioTipo form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhAnuncioTipoForm extends BasetdhAnuncioTipoForm
{
  public function configure()
  {
    $this->useFields(array(
    	'rotativo',
      'multiple',
      'nombre',
      'anchura',
      'altura'
    ));
    
    $this->getWidgetSchema()->setLabels(array(
      'multiple' => '¿Múltiple?',
      'rotativo' => '¿Rotativo?',
      'codigo_alternativo' => 'Código alternativo'
    ));
  }
}
