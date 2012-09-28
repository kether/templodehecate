<?php

/**
 * tdhCriticaVideo filter form.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhCriticaVideoFormFilter extends BasetdhCriticaVideoFormFilter
{
  public function configure()
  {
    $this->useFields(array(
      'medio',
      'url',
      'comentario'
    ));
    
    $this->getWidgetSchema()->setLabels(array(
      'url'	 => 'URL'
    ));
  }
}
