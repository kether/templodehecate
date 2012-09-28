<?php

/**
 * tdhConsultaRespuesta form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhConsultaRespuestaForm extends BasetdhConsultaRespuestaForm
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
    $this->user = $this->getOption('user', $this->context->getUser());
    
    $this->setWidget('consulta_id', new sfWidgetFormInputHidden());
    
    $this->useFields(array(
      'consulta_id',
      'descripcion'
    ));
    
    $this->getWidgetSchema()->setLabels(array(
      'descripcion' => 'Respuesta'
    ));
    
    $this->widgetSchema->setNameFormat('respuesta[%s]');
    $this->getWidgetSchema()->setFormFormatterName('templo');
  }
  
  public function doSave($conn = null)
  {
    $this->getObject()->setUsuarioId($this->user->getUserId());
    $this->getObject()->setIp($this->user->getIP());
    
    parent::doSave($conn);
    
    if($this->getObject()->getConsulta()->getTipo()->esUsuarioAutorizado($this->user))
    {
      $url = $this->context->getController()->genUrl('@tdh_contacto_consulta?codigo='.$this->getObject()->getConsulta()->getCodigo(), true);
      
      $this->context->getMailer()->composeAndSend(
        array(tdhConfig::get('email', 'correo@noresponder.es') => tdhConfig::get('nombre')),
        array($this->getObject()->getConsulta()->getEmail() => $this->getObject()->getConsulta()->getNombre()),
      	'Respuesta a tu consulta sobre '.$this->getObject()->getConsulta()->getTipo()->getNombre().' #'.$this->getObject()->getConsulta()->getCodigo(), 
        "Hola ".$this->getObject()->getConsulta()->getNombre().",\n\nPuedes ver la consulta que has hecho y sus respuestas en la siguiente dirección URL:\n$url\n\nContestaremos lo antes posible a tu petición. Un saludo,\n".tdhConfig::get('nombre')
      );
    }
  }
}
