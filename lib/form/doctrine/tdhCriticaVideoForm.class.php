<?php

/**
 * tdhCriticaVideo form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhCriticaVideoForm extends BasetdhCriticaVideoForm
{
  public function configure()
  {
    $this->useFields(array(
      'critica_id',
      'medio',
      'url',
      'comentario'
    ));
    
    $this->setWidget('critica_id', new sfWidgetFormInputHidden());
    $this->setDefault('critica_id', $this->getOption('critica_id'));
    
    $this->getWidgetSchema()->setLabels(array(
    	'url'		=> 'URL'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
      'url'		=> 'Dirección URL del vídeo o identificador'
    ));
  }
}
