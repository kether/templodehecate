<?php

/**
 * tdhSorteoParticipante form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhSorteoParticipanteForm extends BasetdhSorteoParticipanteForm
{
  public function configure()
  {
    $this->useFields(array(
      'tipo',
      'sorteo_id',
      'ip',
      'numero',
      'nombre',
      'token',
      'email',
      'comentario',
      'domicilio',
    ));
    
    $this->setWidget('domicilio', new sfWidgetFormTextarea());
    $this->setWidget('comentario', new sfWidgetFormTextarea());
  }
}
