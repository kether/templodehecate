<?php

/**
 * tdhConsultaTipo form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhConsultaTipoForm extends BasetdhConsultaTipoForm
{
  public function configure()
  {
    $this->setWidget('consultores_list', new ehAuthWidgetFormUserText(array('label' => 'Consultores')));
    
    $this->setValidator('consultores_list', new ehAuthValidatorUsersText(array('multiple' => true, 'column' => 'username', 'model' => 'ehAuthUser', 'required' => false)));
    
    $this->getWidgetSchema()->setHelps(array(
      'consultores_list' => 'Una lista separadas por retornos de carro de nombres de usuarios que se ocupen de responder a estas cuestiones.'
    ));
  }
}
