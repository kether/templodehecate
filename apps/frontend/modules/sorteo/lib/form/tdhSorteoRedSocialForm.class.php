<?php

class tdhSorteoRedSocialForm extends sfForm
{
  /**
   * @var tdhSorteo
   */
  protected $sorteo;
  
  public function setup()
  {
    $this->sorteo = $this->getOption('sorteo');
    
    if(!($this->sorteo instanceOf tdhSorteo))
    {
      throw new Exception('Debes proporcionar un objeto tdhSorteo a las opciones del constructor de tdhSorteoRedSocialForm');
    }
    
    $tamMaximoMensaje = ($this->getOption('servicio', 'twitter') == 'twitter' ? 140 : 255) - (strlen($this->sorteo->getSufijo()) ? (strlen($this->sorteo->getSufijo()) + 1) : 0);
    
    $this->setWidgets(array(
      'nombre' => new sfWidgetFormInputText(array('label' => 'Nombre o seudónimo')),
      'email' => new sfWidgetFormInputText(array('label' => 'Correo electrónico')),
      'mensaje' => new sfWidgetFormTextarea(array('label' => 'Mensaje', 'default' => $this->sorteo->getMensaje())),
      'servicio' => new sfWidgetFormInputHidden(array('default' => $this->getOption('servicio', 'twitter'))),
      'token' => new sfWidgetFormInputHidden(),
      'token_secret' => new sfWidgetFormInputHidden(),
    ));
    
    $this->setValidators(array(
      'nombre' => new sfValidatorString(array('max_length' => 140, 'required' => true)),
      'mensaje' => new sfValidatorString(array('max_length' => $tamMaximoMensaje)),
      'email' => new sfValidatorEmail(array('required' => true)),
      'servicio' => new sfValidatorString(array('required' => true)),
      'token' => new sfValidatorString(array('required' => true)),
      'token_secret' => new sfValidatorString(array('required' => false)),
    ));
    
    $this->getWidgetSchema()->setHelps(array(
      'nombre' => 'Obligatorio',
      'email' => 'Obligatorio',
      'mensaje' => "El tamaño máximo del mensaje son $tamMaximoMensaje caracteres."
    ));
    
    if(($data = $this->getOption('data')) && is_array($data))
    {
      //facebook
      if($this->getOption('servicio', 'twitter') == 'facebook')
      {
        $this->getWidgetSchema()->setDefaults(array(
          'token'    => $data['token'],
          'nombre'   => $data['info']['name'],
          'email'    => $data['info']['email']
        ));
      }
      //twitter
      else
      {
        $twitter = new ehUtilesTwitter();
        $info = $twitter->usuario($data['screen_name']);
        
        $this->getWidgetSchema()->setDefaults(array(
          'token' => $data['oauth_token'],
          'token_secret' => $data['oauth_token_secret'],
          'nombre' => $info->name
        ));
      }
    }
    
    $this->getWidgetSchema()->setFormFormatterName('templo');
    $this->widgetSchema->setNameFormat('mensaje_sorteo[%s]');
  }
  
  /**
   * @return string
   */
  public function getServicio()
  {
    return isset($this->taintedValues['servicio']) ? $this->taintedValues['servicio'] : $this->getWidget('servicio')->getDefault();
  }
  
  public function isLikeIt()
  {
    if($this->getServicio() == 'facebook')
    {
      $facebook = new ehUtilesFacebook(array('access_token' => $this->taintedValues['token']));
      
      foreach($this->sorteo->getCondicionesByServicio('facebook') as $condicion)
      {
        try
        {
          if(!$facebook->isLikeIt($condicion->getPropietario()))
          {
            return false;
          }
        }
        catch(Exception $e)
        {
          return false;
        }
      }
    }
    
    return true;
  }
  
  /**
   * Procesa y envía a las redes sociales el mensaje formado por el participante.
   * 
   * @param string $id
   * @param string $ip
   */
  public function procesar($ip = '0.0.0.0')
  {
    try
    {
      $participante = new tdhSorteoParticipante();
      
      $participante
        ->setSorteo($this->sorteo)
        ->setToken($this->getValue('token'))
        ->setIp($ip)
        ->setEmail($this->getValue('email'))
        ->setComentario($this->getValue('mensaje'))
        ->setNombre($this->getValue('nombre'))
        ->setTipo($this->getValue('servicio'))
        ->save();
    }
    catch(Exception $e)
    {
      return false;
    }
    
    if($this->getServicio() == 'facebook')
    {
      $facebook = new ehUtilesFacebook(array('access_token' => $this->getValue('token')));
      
      $attatchment = array('message' => $this->getValue('mensaje'));
      
      if($this->sorteo->getUrl())
      {
        $attatchment['link'] = $this->sorteo->getUrl();
        $attatchment['name'] = $this->sorteo->getNombre();
        $attatchment['description'] = $this->sorteo->getEntradilla();
      }
      
      $facebook->publicar($attatchment, 'me');
    }
    else
    {
      $twitter = new ehUtilesTwitter(array('access_token' => $this->getValue('token'), 'access_token_secret' => $this->getValue('token_secret')));
      
      foreach($this->sorteo->getCondicionesByServicio('twitter') as $condicion)
      {
        $twitter->seguir($condicion->getPropietario());
      }
      
      $twitter->enviar(ehUtilesCadena::truncar($this->getValue('mensaje'), (139 - strlen($this->sorteo->getSufijo()))).' '.$this->sorteo->getSufijo());
    }
    
    return $participante->getId();
  }
}