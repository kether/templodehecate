<?php

/**
 * tdhPopular form.
 *
 * @package    form
 * @subpackage tdhPopular
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhPopularForm extends BasetdhPopularForm
{
  public function configure()
  {
    $this->useFields(array(
      'visitas',
      'seccion_id'
    ));
  }
}