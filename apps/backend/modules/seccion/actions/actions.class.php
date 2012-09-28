<?php

require_once dirname(__FILE__).'/../lib/seccionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/seccionGeneratorHelper.class.php';

/**
 * seccion actions.
 *
 * @package    templodehecate
 * @subpackage seccion
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class seccionActions extends autoSeccionActions
{
  public function executeExaminar(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
        
    $this->redirect($object->getUrl() ? 
      $object->getUrl() : 
      $this->getContext()->getConfiguration()->generaUrlFromApp('frontend', 'tdh_seccion', array('seccion_slug' => $object->getSlug()
    )));
  }
}
