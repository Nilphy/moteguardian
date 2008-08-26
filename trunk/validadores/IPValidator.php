<?
/**
 * Chequea la validez de una IP. 
 * Una IP es v�lida si est� formada por 4 grupos de 3 d�gitos tal
 * que el valor de cada grupo est� entre 0 y 255
 *  
 * @author cgalli
 */
class IPValidator extends Validator {
	var $_ip;

	/**
	 * Mediante este constructor se indica la ip a validar.
	 * @param string $ip Campo del formulario que tiene la ip a validar. En formato 'nnn.nnn.nnn.nnn'.

	 * @return IPValidator
	 * @access public
	 */
	function IPValidator ($ip, $key = '') {
		parent::Validator($ip, $key);
		$this->_ip = $ip;
	}


	/**
	 * @return TRUE s�lo si la IP es v�lida
	 */
	function isValid() {
		$ip = $this->_ip;
		if(is_numeric(strpos($ip,'+'))) {
			return false;
		}
		$secciones = explode(".",$ip);
		for($i=0; $i<4; $i++){
			if( is_numeric($secciones[$i]) ){
				if(!((($secciones[0]>0)&&($secciones[3]>0)) && ($secciones[$i]<255))){
					return false;
				}							
			} else return false;
		}
		if(!$secciones[$i]) return true;
	}
}
?>