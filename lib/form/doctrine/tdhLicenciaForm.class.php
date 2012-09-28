<?php

/**
 * tdhLicencia form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhLicenciaForm extends BasetdhLicenciaForm
{
  public function configure()
  {
    $this->useFields(array(
      'nombre',
      'url',
      'descripcion'
    ));
    
    $this->setWidget('descripcion', new sfWidgetFormTextarea());
    $this->setValidator('url', new sfValidatorUrl(array('required' => false)));
    
    $this->getWidgetSchema()->setLabels(array(
      'url' => 'URL',
      'descripcion' => 'Descripción'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
      'url'	=> 'Dirección URL de una página que explique el tipo de licencia',
      'descripcion' => 'Breve descripción de lo que permite esta licencia con el contenido que está asociado'
    ));
  }
}
