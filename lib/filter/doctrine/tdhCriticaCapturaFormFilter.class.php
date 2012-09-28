<?php

/**
 * tdhCriticaCaptura filter form.
 *
 * @package    filters
 * @subpackage tdhCriticaCaptura *
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class tdhCriticaCapturaFormFilter extends BasetdhCriticaCapturaFormFilter
{
  public function configure()
  {
    $this->useFields(array(
    	'comentario',
    	'tam_peq',
    	'tam_med',
    	'tam_gra'
    ));
    
    $this->getWidgetSchema()->setLabels(array(
      'tam_peq' => '¿Tamaño pequeño?',
    	'tam_med' => '¿Tamaño medio?',
    	'tam_gra' => '¿Tamaño grande?'
    ));
  }
}