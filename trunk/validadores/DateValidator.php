<?
/**
 * Chequea la validez de una fecha. Una fecha es v�lida si es un d�a h�bil (de lunes a viernes).
 * @example No son v�lidos los siguientes ejemplos:
 * <ul>
 * 	<li> 16/12/2006
 * 	<li> 04/12/2006
 * </ul>
 * @access public
 * @author mmazzei
 */
class DateValidator extends Validator {
	var $_fecha;

	/**
	 * Mediante este constructor se indica la fecha a validar.
	 * @param string $fecha		Campo que representa la fecha a validar. En formato dd/mm/YYYY.
	 * @param string $key		Clave de internacionalizaci�n del mensaje a mostrar en caso de error.
	 * @return DateValidator
	 * @access public
	 */
	function DateValidator ($fecha, $key = '') {
		$this->_fecha = $fecha;

		parent::Validator('', $key);
	}


	/**
	 * @return TRUE s�lo en caso de que la fecha indicada sea un dia h�bil (de lunes a viernes).
	 */
	function isValid() {
		$fecha = $_REQUEST[$this->_fecha];

		// Averiguo si es es un sabado o domingo
		$timestamp = strtotime( convertirFecha2YMD($fecha));
		$datosFecha = getdate($timestamp);

		// 0 es domingo y 6 es sabado
		return (($datosFecha["wday"] != 0) && ($datosFecha["wday"] != 6));
	}
}
?>