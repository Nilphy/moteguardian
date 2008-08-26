<?
/**
 * Contiene la informaci�n de destino que se utiliza para pasar de una acci�n a la siguiente. Los destinos
 * pueden ser otra acci�n o una URL.
 * 
 * ----------------------------------------
 *      iOnix - PHP Framework - 2006
 * ----------------------------------------
 * Jorge Barbosa      <jmbarbosa@gmail.com>
 * Alejandro Molinari <amolinari@gmail.com>
 * ----------------------------------------
 *
 * @version 1.0
 * @package actions
 * @author jbarbosa
 * @author amolinari
 */
class ActionConnector
{
	/**
	 * Nombre de la acci�n 
	 *
	 * @var string
	 */
	var $_action;
	
	/**
	 * Mensaje que se le va a transferir a la pr�xima acci�n
	 *
	 * @var string
	 */
	var $_message;
	
	/**
	 * Par�metros que se le van a transferir a la pr�xima acci�n
	 *
	 * @var array
	 */
	var $_params;
	
	/**
	 * URL a la cual se va a transferir
	 *
	 * @var string
	 */
	var $_url;
	
	/**
	 * Constructor de la clase
	 *
	 * @access public
	 * @return void
	 */
	function ActionConnector()
	{		
	}
	
	/**
	 * Guarda los datos de la pr�xima acci�n a la cual se va a transferir al ejecutar el m�todo execute()
	 * 
	 * @access public
	 * @param unknown_type $action
	 * @param unknown_type $message
	 * @param unknown_type $params
	 * @return void
	 */
	function setNextAction($action, $message = '', $params = '')
	{
		$this->_action = $action;
		$this->_message = $message;
		$this->_params = $params;
	}
	
	/**
	 * Guarda el valor de la URL a la cual se va a transferir cuando se llame al m�todo execute()
	 *
	 * @access public
	 * @param unknown_type $url
	 * @return void
	 */
	function setRedirect($url)
	{
		$this->_url = $url;		
	}
	
	/**
	 * Transfiere el control a la siguiente acci�n o a la URL especificada
	 * 
	 * @access public
	 * @return void
	 */
	function execute()
	{
		// Se ejecuta la URL o la acci�n
		if ($this->_url)
		{
			Application::Redirect($this->_url);
		}
		else if ($this->_action)
		{
			Application::Go($this->_action, $this->_message, $this->_params);
		}
	}
}
?>