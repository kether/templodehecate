<?php

/**
 * tdhClientePerfil form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 */
class tdhClientePerfilForm extends ehForoPerfilForm
{
  /**
   * @see ehForoPerfilForm
   */
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array(
    	'nombre',
      'apellidos',
      'nick',
      'sexo',
      'fecha_nacimiento',
      'email',
      'web',
      'residencia',
      'pais',
      'idioma',
      'zona_horaria',
    	'perfil_gplus',
    	'perfil_paypal',
    	'firma',
    	'foro_a_templo',
    	'boletines',
    ));
    
    $this->getWidgetSchema()->setFormFormatterName('foro');
  }
}
