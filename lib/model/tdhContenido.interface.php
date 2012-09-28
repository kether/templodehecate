<?php

interface tdhContenido
{  
  /**
   * Devuelve el objeto del mensaje asociado al hilo, a su vez asociado al contenido, o uno nuevo si el contenido es nuevo.
   * 
   * @return mixed Devuelve el objeto del mensaje asociado al hilo y el contenido
   */
  public function getMensaje();
  
  /**
   * Devuelve el identificador de enrutamiento del contenido según la configuración routing.yml
   * 
   * @return string
   */
  public function getRouting();
  
  /**
   * Devuelve la URL completa en función de la APP.
   * 
   * @param string $app
   * @return string
   */
  public function getUrlForApp($app);
  
  public function getTitular();
  
  public function getRelacionados();
}