<?php

class ehForoAvatarForm extends sfForm
{
  protected $user = null;

  public function setUser($user)
  {
    $this->user = $user;
  }

  public function setup()
  {
    $this->setWidgets(array(
      'fichero'    => new sfWidgetFormInputFile()
    ));
    
    $this->setValidators(array(
      'fichero'   => new sfValidatorFile(array(
        'max_size'    => 51200,
        'mime_types'  => 'web_images'
      ), array(
        'max_size'    => 'El tamaño máximo permitido para el fichero es de 50 kbytes.'
      ))
    ));
    
    $this->widgetSchema->setNameFormat('eh_foro_avatar[%s]');
    $this->getWidgetSchema()->setFormFormatterName('foro');
  }

  public function grabar()
  {
    if($this->user instanceOf ehForoSecurityUser)
    {
      $user = $this->user; 
    }
    else
    {
      return;
    }
    
    if($user->isAuthenticated())
    {
      $file = $this->getValue('fichero');
      $baseFilename = $user->getUserName().'.png';
      $dir = ehForoConfig::getDirAvatarsUploaded().'/';
      
      $image = new ehUtilesImagen($file->getTempName());
      
      // Grabamos la imagen normal (90px)
      $fileAndDir = $dir.$baseFilename;
      if(file_exists($fileAndDir)) unlink($fileAndDir);
      $image
        ->setFicheroDestino($fileAndDir)
        ->setFormatoSalida(ehUtilesImagen::FORMATO_PNG)
        ->setMaxAlto(ehForoConfig::getStatic('avatar_size_normal'))->setMaxAncho(ehForoConfig::getStatic('avatar_size_normal'))
        ->save();
      
      // Y la imagen reducida a (50px) con el prefijo "50px-" en el fichero
      $fileAndDir = $dir.ehForoConfig::getStatic('avatar_size_mini').'px-'.$baseFilename;
      if(file_exists($fileAndDir)) unlink($fileAndDir);
      $image
        ->setFicheroDestino($fileAndDir)
        ->setFormatoSalida(ehUtilesImagen::FORMATO_PNG)
        ->setMaxAlto(ehForoConfig::getStatic('avatar_size_mini'))->setMaxAncho(ehForoConfig::getStatic('avatar_size_mini'))
        ->save();
      
      if($user->hasPerfil())
      {        
        $user->setSrcAvatar(ehForoConfig::getSrcAvatarsUploaded().'/'.ehForoConfig::getStatic('avatar_size_mini').'px-'.$baseFilename);
        $user->getPerfil()->setUriAvatar(ehForoConfig::getSrcAvatarsUploaded().'/'.$baseFilename);   
        $user->getPerfil()->save();
      }
    }
  }
  
  public function bindAndGrabar($taintedValues, $taintedFiles)
  {
    $this->bind($taintedValues, $taintedFiles);
    
    if($this->isValid())
    {
      $this->grabar();
      return true;
    }
    else
    {
      return false;
    }
  }
  
}