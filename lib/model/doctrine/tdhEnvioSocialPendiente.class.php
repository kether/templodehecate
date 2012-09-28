<?php

/**
 * tdhEnvioSocialPendiente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class tdhEnvioSocialPendiente extends BasetdhEnvioSocialPendiente
{
  public function enviarInmediatamente($eliminar = true)
  {
    if($this->getServicio() == 'twitter')
    {
      $twitter  = new ehUtilesTwitter();
      $bitly    = new ehUtilesBitly();
      
      $flag = $twitter->enviar(ehUtilesCadena::truncar($this->getNombre(), 115).' '.$bitly->acortar($this->getUrl()));
    }
    elseif($this->getServicio() == 'facebook')
    {
      $facebook = new ehUtilesFacebook();
      $flag     = $facebook->publicar(array(
        'name'        => $this->getNombre(),
        'description' => $this->getDescripcion(),
        'message'     => $this->getMensaje(),
        'picture'     => $this->getImagen(),
        'link'        => $this->getUrl()
      ));
    }
    
    if($eliminar && $flag)
    {
      $this->delete();
    }
  }
}