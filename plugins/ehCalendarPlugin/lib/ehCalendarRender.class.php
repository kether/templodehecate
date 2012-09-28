<?php

/**
 * Esta clase abstracta es el interfaz para renderizar en formato tabla o lista los eventos de un calendario.
 * 
 * @package       ehCalendarPlugin
 * @subpackage    lib
 * @author        Pablo Floriano <p.floriano@estudiohecate.com>
 * @version       ehCalendarRender.class.php 21/10/2010 13:01:00
 */
abstract class ehCalendarRender
{
  protected $decorator     = 'table';
  
  protected $decoratorsLayout = array(
    'table'  => '<table><thead><tr><th colspan="7" class="eh_calendar_month">%month%</th></tr><tr><th>%monday%</th><th>%tuesday%</th><th>%wednesday%</th><th>%thursday%</th><th>%friday%</th><th>%saturday%</th><th>%sunday%</th></tr></thead><tbody>%body%</tbody></table>',
    'vcal'   => "BEGIN:VCALENDAR\nPRODID:-//Estudio Hecate//ehCalendarPlugin//ES\nMETHOD:PUBLISH\nX-WR-CALNAME;VALUE=TEXT:%calname%\nVERSION:2.0\n%events%END:VCALENDAR"
  );
  
  protected $decoratorsLine = array(
    'table'  => '<tr id="eh_calendar_week_%week%">%line%</tr>'
  );
  
  protected $decoratorsRegister = array(
    'table'  => '<td id="eh_calendar_%day%" class="eh_calendar_day_%mark%">%register%</td>'
  );
  
  abstract public function render($options = array());
  
  /** 
   * @return string El nombre del calendario
   */
  abstract public function getName();
  
  public function renderVcal($options = array())
  {
    $decorator = $this->decoratorsLayout['vcal'];
    
    $search = array(
      '%calname%',
      '%events%'
    );
    
    $replace = array(
      $this->getName(),
      $this->renderVcalEvents($options)
    );
    
    return str_replace($search, $replace, $decorator);
  }
  
  protected function renderVcalEvents($options = array())
  {
    $decoratorAll = '';
    
    foreach($this->eventsList as $event)
    {
      $decoratorAll .= $event->renderVcal();
    }
    
    return $decoratorAll;
  }
  
  /**
   * Interpreta el marco de la tabla del mes del calendario en función de los decoradores.
   * 
   * @param array $options Una matriz de opciones opcionales
   * @return string Cadena HTML para imprimir en pantalla
   */
  protected function renderProcessLayout($options = array())
  {
    $daysOfWeekTags   = array('%monday%', '%tuesday%', '%wednesday%', '%thursday%', '%friday%', '%saturday%', '%sunday%');
    $daysOfWeekWords  = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
    
    $decorator = $this->decoratorsLayout[$this->decorator];
    $decorator = str_replace($daysOfWeekTags, $daysOfWeekWords, $decorator);
    
    // Dependencia con Symfony para poner el el nombre del mes en la cultura del navegador
    $date = new sfDateFormat(isset($options['culture']) ? $options['culture'] : sfConfig::get('sf_default_culture', 'es'));
    
    $decorator = str_replace('%month%', $date->format($this->datetime->format('U'), 'MMMM yyyy'), $decorator);
    $decorator = str_replace('%body%', $this->renderProcessLines($options), $decorator);
    
    return $decorator;
  }
  
  protected function renderProcessLines($options = array())
  {
    $datetime = $this->datetime;
    
    $nbDays   = $datetime->format('t');
    
    $dayFirst = new DateTime($datetime->format('Y-m-01'));
    $dayLast  = new DateTime($datetime->format('Y-m-'.$nbDays));
        
    $decorator    = $this->decoratorsLine[$this->decorator];
    $decoratorAll = '';
    
    $datetimeLast  = new DateTime(date('Y-m-d', $dayLast->format('U') + 86400 * (7 - $dayLast->format('N'))));
    
    for($i = $dayFirst->format('U'); (integer)$datetimeLast->format('Ymd') >= (integer)date('Ymd', $i); $i = $i + 608400)
    {     
      $datetimeWeek = new DateTime(date('Y-m-d', $i));
      $decoratorAux = str_replace('%week%', date('Y_W', $i), $decorator);
      $decoratorAux = str_replace('%line%', $this->renderProcessFields($datetimeWeek, $options), $decoratorAux);
      
      $decoratorAll .= $decoratorAux;
    }
    
    return $decoratorAll;
  }
  
  protected function renderProcessFields(DateTime $week, $options = array())
  {
    $dayOfWeek      = $week->format('N');
    
    $datetimeBegin  = new DateTime(date('Y-m-d', $week->format('U') - 86400 * ($dayOfWeek - 1)));
    $datetimeEnd    = new DateTime(date('Y-m-d', $week->format('U') + 86400 * (7 - $dayOfWeek)));
    
    $decorator    = $this->decoratorsRegister[$this->decorator];
    $decoratorAll = '';
    
    for($i = $datetimeBegin->format('U'); $i <= $datetimeEnd->format('U'); $i += 86400)
    {
      $decoratorAux  = str_replace('%register%', $this->renderProcessEvents(new DateTime(date('Y-m-d', $i)), $options), $decorator);
      $decoratorAux  = str_replace('%day%', date('Y_m_d', $i), $decoratorAux);
      $decoratorAux  = str_replace('%mark%', (date('Y-m-d', $i) == $this->datetimeNow->format('Y-m-d') ? 'now' : 'other'), $decoratorAux);
      
      $decoratorAll .= $decoratorAux;
    }
    
    return $decoratorAll;
  }
  
  protected function renderProcessEvents(DateTime $day, $options = array())
  {
    $decoratorAll = '<div class="eh_calendar_field_day">'.$day->format('d').'</div>';
    
    if(isset($this->events[$day->format('Y-m-d')]))
    {
      foreach($this->events[$day->format('Y-m-d')] as $event)
      {
        $decoratorAll .= $event->render($options);
      }
    }
    
    return $decoratorAll;
  }
}