<?php

/**
 * tdhHojaDeEstilo form.
 *
 * @package    form
 * @subpackage tdhHojaDeEstilo
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhHojaDeEstiloForm extends BasetdhHojaDeEstiloForm
{
  public function configure()
  {
    $this->useFields(array(
      'title',
      'filename',
      'media',
      'content'
    ));
  }
}