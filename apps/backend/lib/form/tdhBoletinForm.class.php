<?php

class tdhBoletinForm extends sfForm
{
  /**
   * Contexto del entorno
   * 
   * @var sfContext
   */
  protected $context;
  
  /**
   * Acción del entorno
   * 
   * @var sfAction
   */
  protected $action;
  
  public function configure()
  {
    $this->action  = $this->getOption('action');
    $this->context = $this->action->getContext();
    
    $this->setWidgets(array(
      'asunto'      => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormTextarea(array('label' => 'Descripción')),
      'todos'				=> new sfWidgetFormInputCheckbox(array('label' => '¿Enviar a todos?')),
      'rango_min'   => new sfWidgetFormInputText(array('label' => 'Compensar')),
      'rango_max'   => new sfWidgetFormInputText(array('label' => 'Límite'))
    ));
    
    $this->setValidators(array(
    	'asunto'      => new sfValidatorString(array('required' => false, 'max_length' => 255)),
      'descripcion' => new sfValidatorString(array('required' => true)),
      'todos'				=> new sfValidatorBoolean(),
      'rango_min'   => new sfValidatorNumber(array('required' => false)),
      'rango_max'   => new sfValidatorNumber(array('required' => false))
    ));
    
    $this->getWidgetSchema()->setHelps(array(
    	'descripcion' => 'Añade una anotación al boletín. Puedes usar markdown para enriquecerlo.',
    	'todos' => 'Envía el boletín a todos, tengan o no activada la casilla del email.',
      'rango_min' => 'Valor numérico de la posición inicial del cursor (offset) en la base de datos de los usuarios.',
      'rango_max' => 'Límite máximo (limit) de usuarios para enviar el email.'
    ));
    
    $this->getWidgetSchema()->setFormFormatterName('templo');
    $this->getWidgetSchema()->setNameFormat('boletin[%s]');
  }
  
  public function bindAndSend($taintedValues)
  {
    $this->bind($taintedValues);
    
    if($this->isValid($taintedValues))
    {
      $para = array();
      $perfiles = Doctrine::getTable('tdhPerfil')->retrieveForBoletin($this->getValue('todos'), $this->getValue('rango_min'), $this->getValue('rango_max'));
      
      foreach($perfiles as $perfil)
      {
        if(ehUtilesCadena::validarEmail($perfil->getEmail()))
        {
          $para[$perfil->getEmail()] = $perfil->getNickArreglado();
        }
      }
      
      // Ponemos en cola los eMails
      if($para)
      {        
        $fichero = sfConfig::get('sf_upload_dir').'/newsletter/boletin-'.date('YmdHi').'.html';
        
        $descripcion = new ehUtilesCadenaRica($this->getValue('descripcion'));
        
        $partial = $this->action->getPartial('boletin/correo', array(
        	'asunto'      => $this->getValue('asunto'),
        	'descripcion' => $descripcion->setMarkdown(true)->setHTML(false)->getCadenaParseada(),
        	'fichero'			=> $fichero
        ));
        
        try
        {
          $mensaje = Swift_Message::newInstance()
            ->setFrom(tdhConfig::get('email', 'email@example.com'), tdhConfig::get('nombre_boletin'))
            ->setTo($para)
            ->setSubject($this->getValue('asunto') ? $this->getValue('asunto') : tdhConfig::get('asunto_boletin'))
            ->setBody($partial, 'text/html');
        }
        catch(Exception $e)
        {
          $this->context->getLogger()->err('Uno o varios e-mails entregados son inválidos.');
        }
        
        file_put_contents($fichero, $partial);
        
        $this->context->getMailer()->batchSend($mensaje);
      }
      
      return true;
    }
    else
    {
      return false;
    }
  }
}