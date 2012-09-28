<?php

class tdhRoute extends sfRoute
{
  public function matchesUrl($url, $context = array())
  {    
    if(false === $parameters = parent::matchesUrl($url, $context))
    {
      return false;
    }
    
    if(sfConfig::get('app_mobile_domain', false) == $context['host'])
    {
      if(isset($parameters['mobile']) && $parameters['mobile'] == false)
      {
        unset($parameters['mobile']);
      }
      else
      {
        $parameters = array_merge(array('mobile' => true), $parameters);
      }
    }
    
    return $parameters;
  }
  
  /**
   * Genera una URL de unos parámetros dados
   *
   * @param   mixed     $params     The parameter values
   * @param   array     $context    The context
   * @param   Boolean   $absolute   Whether to generate an absolute URL
   *
   * @return  string    The generated URL
   */
  public function generate($params, $context =  array(), $absolute = false)
  {
    if(isset($params['mobile']) && sfConfig::get('app_mobile_domain', false))
    {
      unset($params['mobile']);
            
      return 'http://'.sfConfig::get('app_mobile_domain').parent::generate($params, $context, false);
    }
    else
    {
      return parent::generate($params, $context, $absolute);
    }
  }
}