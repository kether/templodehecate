<?php

/**
 * tdhMenu form.
 *
 * @package    form
 * @subpackage tdhMenu
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhMenuForm extends BasetdhMenuForm
{
  public function configure()
  {
    $this->useFields(array(
      'estado_portada',
      'nombre',
      'ordinal',
      'descripcion',
      'enlace',
      'menu_id'
    ));
  }
}