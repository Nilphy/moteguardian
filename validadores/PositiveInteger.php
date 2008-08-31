<?
/**
 * Validador para campos num�ricos enteros positivos.
 * 
 * 
 * @version 1.0
 * @author cgalli
 */ 
class PositiveInteger extends Validator
{
	/**
	 * Constructor de la clase
	 * @access public
	 * @param $field (string) campo a validar
	 * @param $key (sting) clave de internacionalizaci�n
	 */ 
	function Numeric($field, $key = '')
	{
		parent::Validator($field, $key);
	}

	/**
	 * Indica si el campo es v�lido
	 * @access public
	 * @return (bool) TRUE si el campo es v�lido, FALSE si no lo es
	 */ 
	function isValid() {
		$fl1 = floatval($_REQUEST[$this->_field]);
		$fl2 = floatval(intval($_REQUEST[$this->_field]));
		if (trim(!empty($_REQUEST[$this->_field]))) {
			if (!is_numeric(addslashes($_REQUEST[$this->_field])) || (!($fl1 == $fl2)) || ( $fl1 > 1000000000 ) || ( $fl1 < 0 ) ){
				return false;
			}
		}
		return true;
	}
	
	/**
	 * Retorna el mensaje de error cuando el campo no es v�lido
	 * @access public
	 * @return (string) mensaje de error
	 */ 
	function getError()
	{
		if ($this->_key)
		{
			return PropertiesHelper::GetKey($this->_key);
		}
				
		return 'El campo ' . $this->_field . ' debe ser un valor num�rico entero positivo';
	}	
}
?>