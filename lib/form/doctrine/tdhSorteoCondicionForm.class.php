<?php

/**
 * tdhSorteoCondicion form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhSorteoCondicionForm extends BasetdhSorteoCondicionForm
{
  public function configure()
  {
    $this->useFields(array(
      'sorteo_id',
      'tipo',
      'nombre',
      'propietario',
      'url'
    ));
    
    $this->getWidgetSchema()->setLabels(array('url' => 'URL', 'propietario' => 'Identidad'));    
    $this->getWidgetSchema()->setHelps(array(
      'url' => 'La dirección de la página web de Facebook que tendrán que pulsar en "Me gusta" (ejemplo: <a href="http://www.facebook.com/templodehecate">http://www.facebook.com/templodehecate</a>)',
      'propietario' => 'El <i>screen_name</i> de Twitter (ejemplo: "templodehecate") o el <i>id</i> de la página de Facebook (puedes verlo en el <i>graph</i>: <a href="https://graph.facebook.com/templodehecate">https://graph.facebook.com/templodehecate</a>)'
    ));
    
    $this->setValidator('url', new sfValidatorUrl(array('required' => false)));
  }
}
