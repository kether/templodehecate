<?php

/**
 * tdhFeedExterno form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhFeedExternoForm extends BasetdhFeedExternoForm
{
  public function configure()
  {
    $this->useFields(array('nombre', 'url_feed', 'url_web'));
    
    $this->getWidgetSchema()->setLabels(array(
    	'url_feed' => 'URL del feed',
    	'url_web' => 'URL de inicio'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
    	'url_feed' => 'Dirección URL del feed RSS/Atom',
    	'url_web' => 'Dirección URL de la página inicio normal del que procede el feed'
    ));
  }
}
