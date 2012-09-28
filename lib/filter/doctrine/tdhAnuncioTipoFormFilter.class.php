<?php

/**
 * tdhAnuncioTipo filter form.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhAnuncioTipoFormFilter extends BasetdhAnuncioTipoFormFilter
{
  public function configure()
  {
    $this->useFields(array(
      'nombre',
      'anchura',
      'altura',
      'rotativo',
      'multiple'
    ));
    
    $this->getWidgetSchema()->setLabels(array(
      'multiple' => '¿Múltiple?',
      'rotativo' => '¿Rotativo?'
    ));
  }
}
