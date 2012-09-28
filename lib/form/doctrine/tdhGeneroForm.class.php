<?php

/**
 * tdhGenero form.
 *
 * @package    form
 * @subpackage tdhGenero
 */
class tdhGeneroForm extends BasetdhGeneroForm
{
  public function configure()
  {
    $this->useFields(array(
      'nombre'
    ));
  }
}