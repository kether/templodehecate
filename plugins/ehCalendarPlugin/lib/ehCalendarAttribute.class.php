<?php

/**
 * ehCalendarAttribute.class.php permite permite añadir atributos a un evento
 * 
 * @package       ehCalendarPlugin
 * @subpackage    lib
 * @author        Pablo Floriano <p.floriano@estudiohecate.com>
 * @version       ehCalendarAttribute.class.php 21/10/2010 13:14:00
 */
class ehCalendarAttribute
{
	/**
   * Nombre del atributo.
   * 
   * @var string 
   */
  protected $name;
	
	/**
	 * El valor del atributo.
	 * 
	 * @var mixed 
	 */
	protected $value;
	
	/**
	 * El constructor de la clase necesita el nombre del atributo para instanciar el objeto.
	 * 
	 * @param string $name El nombre del atributo
	 * @param mixed $value El valor del atributo, será nulo si no se especifica nada.
	 */
	public function __construct($name, $value = null)
	{
		$this->name   = $name;
		$this->value  = $value;
	}
	
	/**
   * @return string Devuelve el nombre del atributo
   */
	public function __toString()
	{
		return $this->name;
	}
	
	/**
	 * @return string Devuelve el nombre del atributo
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
   * @return mixed Devuelve el valor del atributo
   */
	public function getValue()
	{
		return $this->value;
	}
	
	/**
	 * @param string $v
	 * @return ehCalendarAttribute Una instancia modificada del propio objeto
	 */
	public function setName($v)
	{
		$this->name = $v;
		return $this;
	}
	
	/**
   * @param mixed $v
   * @return ehCalendarAttribute Una instancia modificada del propio objeto
   */
  public function setValue($v)
  {
    $this->value = $v;
    return $this;
  }
}