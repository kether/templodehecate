<?php

/**
 * tdhFeedExterno filter form.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhFeedExternoFormFilter extends BasetdhFeedExternoFormFilter
{
  public function configure()
  {
    $this->useFields(array('nombre', 'url_feed', 'url_web'));
    
    $this->getWidgetSchema()->setLabels(array(
    	'url_feed' => 'URL del feed',
    	'url_web' => 'URL de inicio'
    ));
  }
}
