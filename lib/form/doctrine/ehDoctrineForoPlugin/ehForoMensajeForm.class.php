<?php

/**
 * ehForoMensaje form.
 *
 * @package    form
 * @subpackage ehForoMensaje
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ehForoMensajeForm extends PluginehForoMensajeForm
{
  public function configure()
  {
  	parent::configure();
    
    $this->useFields(array(
  	  'estado_activo',
  	  'html',
  	  'bbcode',
  	  'nl2br',
  	  'emoticonos',
  	  'markdown',
  	  'firma',
  	  'asunto',
  	  'cuerpo',
  	  'visible_desde',
  	  'nombre_usuario'
  	));
  }
}