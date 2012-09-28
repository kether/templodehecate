<?php

/**
 * tdhEditor form.
 *
 * @package    form
 * @subpackage tdhEditor
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhEditorForm extends BasetdhEditorForm
{
  public function configure()
  {
    $this->useFields(array(
      'nombre',
      'web'
    ));
  }
}