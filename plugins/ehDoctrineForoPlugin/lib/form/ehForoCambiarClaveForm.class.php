<?php

class ehForoCambiarClaveForm extends ehAuthChangePasswordForm
{
  public function configure()
  {
    $this->getWidgetSchema()->setFormFormatterName('foro');
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('eh_auth_plugin');
  }
}