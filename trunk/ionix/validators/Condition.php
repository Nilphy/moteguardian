<?
/**
 * Eval�a si se cumple o no una condici�n.
 *
 * ----------------------------------------
 *      iOnix - PHP Framework - 2006
 * ----------------------------------------
 * Jorge Barbosa      <jmbarbosa@gmail.com>
 * Alejandro Molinari <amolinari@gmail.com>
 * ----------------------------------------
 *  
 * @version 1.0
 * @package validators
 * @author jbarbosa
 * @author amolinari
 */ 
class Condition extends Validator
{
	/**
	 * Condici�n a evaluar
	 * @access private
	 * @var bool
	 */ 
	var $_condition;
	
	/**
	 * Eval�a si se cumple la condici�n especificada
	 * 
	 * @access public
	 * @param $condition (bool) condici�n a evaluar
	 * @param $key (sting) clave de internacionalizaci�n
	 */ 
	function Condition($condition, $key = '')
	{
		parent::Validator("", $key);
		$this->_condition = $condition;
	}

	/**
	 * @see Validator 
	 */ 
	function isValid()
	{	
		return $this->_condition;
	}	
}
?>