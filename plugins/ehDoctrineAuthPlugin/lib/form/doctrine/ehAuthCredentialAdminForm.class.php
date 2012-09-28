<?php

/**
 * ehCredential form.
 *
 * @package    form
 * @subpackage eh_credential
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ehAuthCredentialAdminForm extends BaseehAuthCredentialForm
{
  public function configure()
  {
    unset(
      $this['users_list'],
      $this['updated_at'], 
      $this['created_at']
    );
    
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('eh_auth_plugin');
  }
}
