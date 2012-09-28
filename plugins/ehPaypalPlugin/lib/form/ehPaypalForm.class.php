<?php

class ehPaypalForm extends sfForm
{
  public function configure()
  {
    $this->getWidgetSchema()->setFormFormatterName('list');
  }
}