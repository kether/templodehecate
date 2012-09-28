<?php

/**
 * tdhSeccionTipo form.
 *
 * @package    form
 * @subpackage tdhSeccionTipo
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhSeccionTipoForm extends BasetdhSeccionTipoForm
{
  public function configure()
  {
    $this->useFields(array(
      'nombre',
      'es_juego'
    ));
  }
}