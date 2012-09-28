<?php

/**
 * ehCalendarEvent permite crear una instancia de un evento.
 * 
 * @package       ehCalendarPlugin
 * @subpackage    lib
 * @author        Pablo Floriano <p.floriano@estudiohecate.com>
 * @version       ehCalendarEvent.class.php 21/10/2010 13:14:00
 */
class ehCalendarEvent
{
	/**
	 * Título o nombre del evento.
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * Cadena con la URL a la descripción completa del evento.
	 * 
	 * @var string
	 */
	protected $url = '';
	
	/**
	 * Número ordinal del estilo del evento
	 * 
	 * @var integer
	 */
	protected $nbStyle = 1;
	
	/**
   * Título o nombre del evento.
   * 
   * @var array
   */
	protected $attributes;
	
	/**
   * Fecha y hora de comienzo del evento.
   * 
   * @var DateTime
   */
  protected $datetimeStart;
  
  /**
   * Fecha y hora de comienzo del final del evento.
   * 
   * @var DateTime
   */
  protected $datetimeEnd;
  
  protected $decorator = array(
    'table'   => '<div class="eh_calendar_event eh_calendar_style_%nbstyle%"><a href="%url%">%title%</a></div>',
    'vcal'    => "BEGIN:VEVENT\nSUMMARY:%summary%\nLOCATION:%location%\nURL;VALUE=URI:%uri%\nUID:%uid%\nDTSTART;VALUE=DATETIME:%dtstart%\nDTEND;VALUE=DATETIME:%dtend%\nDESCRIPTION;ENCODING=QUOTED-PRINTABLE:%description%\nEND:VEVENT\n"
  );
  
  public function __construct($name, DateTime $start, DateTime $end, $attributes = array())
  {
  	$this->setName($name);
  	
  	$this->datetimeStart = $start;
  	$this->datetimeEnd   = $end;
  	
  	$this->attributes = $attributes;
  }
  
  /**
   * return string El nombre del evento 
   */
  public function __toString()
  {
  	return $this->name;
  }
  
  /**
   * return string El nombre del evento 
   */
  public function getName()
  {
  	return $this->name;
  }
  
  /**
   * @return string Identificador único del evento
   */
  public function getId()
  {
  	return  $this->id;
  }
  
  /**
   * @return string Dirección URL a una página con detalles del evento
   */
  public function getUrl()
  {
    return  $this->url;
  }
  
  /**
   * @return string Clases con un estilo identificado en una hoja CSS
   */
  public function getNbStyle()
  {
    return  $this->nbStyle;
  }
  
  public function getAttribute($name)
  {
  	return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
  }
  
  /**
   * return DateTime Una instancia de la hora y fecha del comienzo del evento 
   */
  public function getStart()
  {
  	return $this->datetimeStart;
  }
  
  /**
   * return DateTime Una instancia de la hora y fecha del final del evento 
   */
  public function getEnd()
  {
    return $this->datetimeEnd;
  }
  
  /**
   * Graba en el objeto el nombre identificativo del evento.
   * 
   * @param string $v Cadena con la URL
   * @return ehCalendarEvent Una instancia del objeto modificado
   */
  public function setName($v)
  {
    $this->name  = $v;
    $this->id    = ehCalendar::slug($v);
    
    return $this;
  }
  
  /**
   * Graba en el objeto la URL de la dirección con la página en detalle del evento.
   * 
   * @param string $v Cadena con la URL
   * @return ehCalendarEvent Una instancia del objeto modificado
   */
  public function setUrl($v)
  {
    $this->url = $v;
    return $this;
  }
  
  /**
   * Setea el número del estilo
   * 
   * @param integer  $v
   * @return ehCalendarEvent Instancia modificada del propio objeto
   */
  public function setNbStyle($v)
  {
    $this->nbStyle = $v;
    return $this;
  }
  
  /**
   * Setea un atributo con su instancia
   * 
   * @param string $name
   * @param ehCalendarAttribute $attribute
   */
  public function setAttribute(ehCalendarAttribute $attribute)
  {
  	$this->attributes[$attribute->getName()] = $attribute;
  	return $this;
  }
  
  public function render($options = array())
  {
  	$decorator = $this->decorator['table'];
  	
  	$decorator = str_replace('%title%', $this->getName(), $decorator);
  	//$decorator = str_replace('%id%', $this->getId(), $decorator);
  	$decorator = str_replace('%nbstyle%', $this->getNbStyle(), $decorator);
  	$decorator = str_replace('%url%', $this->getUrl(), $decorator);
  	
  	foreach($this->attributes as $key => $attribute)
  	{
  		$decorator = str_replace('%'.$key.'%', $attribute->getValue(), $decorator);
  	}
  	
  	return $decorator;
  }
  
  public function renderVcal($options = array())
  {
    $decorator = $this->decorator['vcal'];
    
    $search = array(
      '%summary%', 
      '%location%', 
      '%uri%', 
      '%uid%',
      '%dtstart%', 
      '%dtend%', 
      '%description%'
    );
    
    $replace = array(
      $this->getName(),
      $this->getAttribute('location') ? $this->getAttribute('location')->getValue() : 'Spain',
      $this->getUrl(),
      $this->getId(),
      $this->datetimeStart->format('Ymd').'T'.$this->datetimeStart->format('His').'Z',
      $this->datetimeEnd->format('Ymd').'T'.$this->datetimeEnd->format('His').'Z',
      $this->getAttribute('description') ? str_replace("\r", "=0D=0A=", $this->getAttribute('description')->getValue()) : '',
    );
    
    return str_replace($search, $replace, $decorator);
  }
}