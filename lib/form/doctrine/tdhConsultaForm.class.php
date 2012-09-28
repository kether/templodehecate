<?php

/**
 * tdhConsulta form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhConsultaForm extends BasetdhConsultaForm
{
  /**
	 * @var tdhSecurityUser 
   */
  protected $user = null;
  
  /**
   * @var sfContext
   */
  protected $context = null;
  
  public function configure()
  {
    $this->context = $this->getOption('context', sfContext::getInstance());
    $this->user = $this->getOption('user',$this->context->getUser());
    
    $this->useFields(array(
      'tipo_id',
    	'email',
      'nombre',
      'descripcion',
    ));
    
    $this->setValidator('email', new sfValidatorEmail(array('required' => true)));
    $this->setValidator('nombre', new sfValidatorString(array('required' => true)));
    
    $this->getWidgetSchema()->setLabels(array(
      'email'	=> 'Correo electrónico',
      'descripcion' => 'Descripción'
    ));
    
    $this->widgetSchema['recaptcha']    = new sfWidgetFormReCaptcha(array(
        'public_key'  => ehForoConfig::getStatic('recaptcha_key_public'),
        'label'       => 'reCaptcha',
        'culture'     => sfConfig::get('sf_default_culture'),
        'theme'       => ehForoConfig::getStatic('recaptcha_theme')
    ));
    
    $this->validatorSchema['recaptcha'] = new sfValidatorReCaptcha(array('private_key' => ehForoConfig::getStatic('recaptcha_key_private')), array('captcha' => "El 'captcha' no es válido (captcha inválido)."));
    $this->getWidgetSchema()->setHelp('recaptcha', 'Escribe las dos palabras que aparecen en el recuadro');
    
    $this->widgetSchema->setNameFormat('consulta[%s]');
    $this->getWidgetSchema()->setFormFormatterName('templo');
  }
  
  public function doSave($conn = null)
  {
    $this->getObject()->setUsuarioId($this->user->getUserId());
    $this->getObject()->setIp($this->user->getIP());
    
    parent::doSave($conn);
    
    $this->crearAviso();
  }
  
  public function crearAviso()
  {
    $url = $this->context->getController()->genUrl('@tdh_contacto_consulta?codigo='.$this->getObject()->getCodigo(), true);
    
    $mensaje = new ehForoMensaje();
    
    $mensaje
      ->setNombreInvitado(tdhConfig::get('nombre', 'Estudio Hécate'))
      ->setAsunto('Consulta sobre "'.$this->getObject()->getTipo()->getNombre().'" #'.$this->getObject()->getCodigo())
      ->setHtml(true)
      ->setBbcode(false)
      ->setCuerpo('Una nueva consula enviada por '.$this->getObject()->getNombre().' ('.$this->getObject()->getIp().') en la siguiente URL:<br /><a href="'.$url.'">'.$url.'</a>');
    
    foreach($this->getObject()->getTipo()->getConsultores() as $consultor)
    {
      $aviso = new ehForoMensajePrivado();

      $aviso
        ->setUsuarioDestinoId($consultor->getId())
        ->setMensaje($mensaje)
        ->save();
    }
    
    $this->context->getMailer()->composeAndSend(
      array(tdhConfig::get('email', 'correo@noresponder.es') => tdhConfig::get('nombre')), 
      array($this->getObject()->getEmail() => $this->getObject()->getNombre()),
    	'Consulta sobre '.$this->getObject()->getTipo()->getNombre().' #'.$this->getObject()->getCodigo(), 
      "Hola ".$this->getObject()->getNombre().",\n\nPuedes ver la consulta que has hecho en la siguiente dirección URL:\n$url\n\nContestaremos lo antes posible a tu petición. Un saludo,\n".tdhConfig::get('nombre')
    );
    
  }
}
