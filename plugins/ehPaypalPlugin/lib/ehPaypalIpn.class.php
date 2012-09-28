<?php
/**
 * Plug-in para validar respuestas IPN de PayPal basado en 'PHP Paypal IPN Integration Class'
 * de Micah Carrick <email@micahcarrick.com> adaptada para Symfony y PHP5
 * 
 * @package       estudiohecate
 * @subpackage    paypal
 * @author        Pablo Floriano <p.floriano@estudiohecate.com>
 * @version       pfPayPalIpn.class.php 10/01/2008 2:37:08
 */

class ehPaypalIpn {

  const APP_PAYPAL = 'app_eh_paypal_ipn';
  
  /**
   * Save the last error encountered
   *
   * @var string
   */
  protected $last_error;
  
  /**
   * Do you want save log IPN results to text file?
   *
   * @var boolean
   */
  protected $ipn_log;
    
  /**
   * Holds the IPN response from PayPal  
   *
   * @var string
   */
  protected $ipn_response;

  /**
   * Contains the POST values for IPN
   *
   * @var array
   */
  protected $ipn_data = array();
  
  /**
   * Holds the fields to submit to PayPal
   *
   * @var array
   */
  protected $fields = array();
  
  /**
   * sfForm 
   * 
   * @var sfForm
   */
  protected $form = null;

  public function __construct()
  {
    $this->last_error     = '';
    $this->ipn_response   = '';
    
    $this->paypal_url     = sfConfig::get(self::APP_PAYPAL.'_url', 'https://www.paypal.com/cgi-bin/webscr');
    $this->ipn_log        = sfConfig::get(self::APP_PAYPAL.'_log', true);
      
    // populate $fields array with a few default values.  See the paypal
    // documentation for a list of fields and their data types. These defaul
    // values can be overwritten by the calling script.
    
    $fields = sfConfig::get(self::APP_PAYPAL.'_fields', array('rm'=>'2','cmd'=>'_xclick'));
    foreach($fields as $key => $value)
    {
      $this->addField($key, $value);
    }
  }
  
  /**
   * Adds a key/value pair to the fields array, which is what will be sent to PayPal.
   * If the field is already in the, value will be overwritten.
   *
   * @param string $field
   * @param string $value
   * @param string $type Type of field
   * @param array
   */
  public function addField($field, $value, $type = null, $options = array())
  {
    if($value || !isset($this->fields[$field]))
    {
      $this->fields[$field] = new ehPaypalField($field, $value, $type, $options);
    } 
    
    return $this;
  }
  
  /**
   * Devuelve todos los widgets en un array
   * 
   * @return array
   */
  public function getFields()
  {
    return $this->fields;
  }
  
  /**
   * Devuelve el widget de un campo.
   * 
   * @param string $field
   * @return sfWidgetForm
   */
  public function getField($field)
  {
    return isset($this->fields[$field]) ? $this->fields[$field] : null;
  }
  
  public function getPaypalUrl()
  {
    return $this->paypal_url;
  }
  
  public function getIpnData($field = null, $default_value = null)
  {
    if($field !== null)
    {
      return ( ($this->ipn_data[$field] !== null) ? $this->ipn_data[$field] : $default_value );
    }
    else
    {
      return ( ($this->ipn_data !== null) ? $this->ipn_data : $default_value );
    }
  }
  
  public function validateIpn()
  {

    // parse the paypal URL
    $url_parsed = parse_url($this->paypal_url);      

    // generate the post string from the _POST vars aswell as load the
    // _POST vars into an arry so we can play with them from the calling
    // script.
    $post_string = '';
    
    foreach ($_POST as $field => $value)
    { 
      $this->ipn_data[$field] = $value;
      $post_string .= $field.'='.urlencode(stripslashes($value)).'&'; 
    }
      
    $post_string.="cmd=_notify-validate"; // append ipn command

    // abrimos una conexión a PayPal; asegurarse de que está la extensión OpenSSL habilitada en PHP por el puerto 80 ya no vale.
    //$fp = fsockopen($url_parsed['host'],"80",$err_num,$err_str,30);
    $fp = fsockopen ('ssl://'.$url_parsed['host'], '443', $errno, $errstr, 30);
    
    if(!$fp)
    {
      // could not open the connection.  If loggin is on, the error message
      // will be in the log.
      $this->last_error = "fsockopen error no. $errnum: $errstr";
      $this->logIpnResults(false);       
      return false;
    }
    else
    { 
      // Post the data back to paypal
      fputs($fp, "POST ".$url_parsed['path']." HTTP/1.1\r\n"); 
      fputs($fp, "Host: ".$url_parsed['host']." \r\n"); 
      fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n"); 
      fputs($fp, "Content-length: ".strlen($post_string)."\r\n"); 
      fputs($fp, "Connection: close\r\n\r\n"); 
      fputs($fp, $post_string . "\r\n\r\n"); 

      // loop through the response from the server and append to variable
      while(!feof($fp))
      { 
        $this->ipn_response .= fgets($fp, 1024); 
      } 

      fclose($fp);
    }
      
    if (strpos($this->ipn_response, "VERIFIED") !== FALSE)
    {
      // Valid IPN transaction.
      $this->logIpnResults(true);
      return true;       
    }
    else
    {
      // Invalid IPN transaction.  Check the log for details.
      $this->last_error = 'test'.$this->ipn_response; // 'Falló la validación IPN';
      $this->logIpnResults(false);   
      return false;
    }
        
  }
   
  public function logIpnResults($success)
  {
    if (!$this->ipn_log) return;  // is logging turned off?
    
    // ¿PayPal consiguió procesar el resultado o no? Si es que no, ¿por qué?
    if ($success) $text = "Resultado PayPal IPN: ÉXITO";
    else $text = 'Resultado PayPal IPN: FALLO: '.$this->last_error."";
    
    sfContext::getInstance()->getLogger()->info($text);
    
    // Log the POST variables
    $text = "Variables POST de PayPal IPN: ";
    foreach ($this->ipn_data as $key => $value)
    {
      $text .= "$key => $value, ";
    }
    
    sfContext::getInstance()->getLogger()->info($text);
    
    // Log the response from the paypal server
    $text = "IPN Respuesta del servidor PayPal: ".$this->ipn_response;
    
    sfContext::getInstance()->getLogger()->info($text);
    
  }
  
  public function getForm()
  {
    if($this->form)
    {
      return $this->form;
    }
    
    $form = new ehPaypalForm();
    
    foreach($this->getFields() as $name => $value)
    {
      $form->setWidget($name, $value->getWidget());
    }
    
    $this->form = $form;
    
    return $this->form;
  }

}