<?php

/**
 * tdhArticulo form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhArticuloForm extends BasetdhArticuloForm
{
  public function configure()
  {
    $this->useFields(array('es_aprobado', 'tipo'));
    
    $this->getWidgetSchema()->setLabels(array(
      'es_aprobado' => '¿Aprobado?'
    ));
  }
}
