<?php

/**
 * Permite regenerar una contraseña.
 * 
 * @package     ehDoctrineForoPlugin
 * @subpackage  form
 * @author      Pablo Floriano <p.floriano@estudiohecate.com>
 * @version     ehForoClienteRegenerarForm
 */
class ehForoClienteRegenerarForm extends ehAuthRegeneratePasswordForm
{
  public function configure()
  {
    $this->getWidgetSchema()->setFormFormatterName('foro');
    
    $this->getWidgetSchema()->setLabel('username', 'Usuario o correo electrónico');
    $this->getWidgetSchema()->setHelp('username', 'Introduce el email o usuario que recuerdes');
    
  }
}