<?php

/**
 * ehCalendar permite gestionar e imprimir un calendario para la web.
 * 
 * @package       ehCalendarPlugin
 * @subpackage    lib
 * @author        Pablo Floriano <p.floriano@estudiohecate.com>
 * @version       ehCalendar.class.php 06/03/2008 21:32:38
 */
class ehCalendar extends ehCalendarRender
{	
  /**
   * La colección de eventos contenidos en el calendario.
   * 
   * @var array
   */
  protected $events;
  
  /** 
   * @var array
   */
  protected $eventsList;
  
  /**
   * Nombre identificativo del calendario.
   * 
   * @var string
   */
  protected $name = 'Calendar'; 
  
  /**
   * El día y hora actual.
   *
   * @var DateTime
   */
  protected $datetimeNow;
  
  /**
   * El mes y año que se quiere mostrar del calendario.
   * 
   * @var DateTime
   */
  protected $datetime;
  
  /**
   * @var DateTime
   */
  protected $nextMonth;
  
  /**
   * @var DateTime
   */
  protected $previousMonth;
	
  /**
   * @var integer
   */
  protected $nbStyleEvent  = 1;
  
  public function __construct(DateTime $datetime = null)
  {
    $this->datetimeNow = new DateTime();
    $this->datetime = is_null($datetime) ? $this->datetimeNow : $datetime;
    
    $nbDays   = $this->datetime->format('t');
    
    $this->nextMonth = new DateTime(date('Y-m-d', (strtotime($this->datetime->format('Y-m-').$nbDays) + 90000)));
    $this->previousMonth = new DateTime(date('Y-m-d', (strtotime($this->datetime->format('Y-m-01')) - 90000)));
  }
  
  /**
   * @see plugins/ehCalendarPlugin/lib/ehCalendarRender::getName()
   */
  public function getName()
  {
    return $this->name;
  }
  
  /**
   * @return DateTime Una instancia del mes siguiente a la fecha dada en la variable datetime
   */
  public function getNextMonth()
  {
    return $this->nextMonth;
  }
  
  /**
   * @return DateTime Una instancia del mes anterior a la fecha dada en la variable datetime
   */
  public function getPreviousMonth()
  {
    return $this->previousMonth;
  }
  
  /**
   * Añade un evento al calendario.
   * 
   * @param ehCalendarEvent $event Una instancia del evento
   */
  public function addEvent(ehCalendarEvent $event)
  {
    // Lista de eventos
    $this->eventsList[$event->getId()] = $event;
    
    // Eventos listados según fecha
    for($i = $event->getStart()->format('U'); date('Y-m-d', $i) <= date('Y-m-d', $event->getEnd()->format('U')); $i = $i + 86400)
    {
      $this->events[date('Y-m-d', $i)][] = $event;
    }
    
    return $this;
  }
	
  /**
   * Devuelve una matriz con todos los eventos del calendario.
   * 
   * @return array Una matriz con los eventos
   */
	public function getEvents()
	{
		return $this->events;
	}
	
	/**
	 * @param string $name Nombre del calendario
	 * @return ehCalendar Una instancia del objeto modificado
	 */
	public function setName($name)
	{
	  $this->name = $name;
	  return $this;
	}
	
	/**
   * @param DateTime $datetimeNow Fecha actual
   * @return ehCalendar Una instancia del objeto modificado
   */
	public function setDatetimeNow(DateTime $datetimeNow)
	{
		$this->datetimeNow = $datetimeNow;
		
		return $this;
	}
	
  public function render($options = array())
  {
    $layout = $this->renderProcessLayout($options);
    
    return $layout;
  }
	
  static function slug($text)
  {
    // Reemplazar caracteres que no son ni números ni digitos por "-"
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
   
    // Trim los bordes
    $text = trim($text, '-');
   
    // Transliteral
    if (function_exists('iconv'))
    {
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }
   
    // Sólo diminutivas
    $text = strtolower($text);
   
    // Suprimir caracteres no deseados
    $text = preg_replace('~[^-\w]+~', '', $text);
   
    if (empty($text))
    {
      return 'n-a';
    }
   
    return $text;
  }
}