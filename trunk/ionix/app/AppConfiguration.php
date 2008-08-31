<?
/**
 * Singleton para cargar y administrar la configuraci�n de la aplicaci�n por medio de un archivo XML. El archivo 
 * de configuraci�n est� definido en APP_CONFIG_FILE.
 * 
 * ----------------------------------------
 *      iOnix - PHP Framework - 2006
 * ----------------------------------------
 * Jorge Barbosa      <jmbarbosa@gmail.com>
 * Alejandro Molinari <amolinari@gmail.com>
 * ----------------------------------------
 * 
 * @version 1.0
 * @package app
 * @author jbarbosa
 * @author amolinari
 */ 
class AppConfiguration
{
	/**
	 * Path al archivo de configuraci�n
	 * @access private
	 * @var string
	 */ 
	var $_config_file = APP_CONFIG_FILE;
	
	/**
	 * Array donde se almacena la configuraci�n de la aplicaci�n
	 * @access private
	 * @var array
	 */
	var $_settings;
	
	/**
	 * Constructor de la clase
	 * 
	 * @access private
	 */
	function AppConfiguration()
	{
		$this->loadConfigurationFromXml();
	}

	/**
	 * Devuelve la �nica instancia de esta clase
	 *
	 * @access public
	 * @return AppConfiguration
	 */
	function getInstance()
	{
		static $instance;
		
		if (!$instance)
			$instance = new AppConfiguration();
			
		return $instance;
	}
	
	/**
	 * Procesa y carga en variables de instancia la configuraci�n de la aplicaci�n que se encuentra en el 
	 * archivo XML APP_CONFIG_FILE. Si el archivo no se encuentra no devuelve ning�n error.
	 * 
	 * @access private
	 * @return void
	 */ 
	function loadConfigurationFromXml()
	{				
		// Abrir el archivo XML y obtener el root
		$dom = new DomDocument();
		@$dom->load(realpath(".") . '/' . $this->_config_file);
		
		if (!$dom)
			return ;

		$this->_processI18N($dom);
		$this->_processAuthenticationMethod($dom);
		$this->_processSettings($dom);
	}
	

	/**
	 * Devuelve el nombre de archivo para el idioma indicado, de acuerdo a la configuracion en el XML correspondiente
	 * 
	 * @access public
	 * @param (string) $language idioma del cual se desea obtener el nombre de archivo asociado
	 * @return (string) nombre de archivo de internacionalizaci�n. Si no existe devuelve vac�o.
	 */
	function getLanguageFileName($language)
	{
		$languages = $this->_settings["i18n"];
		
		foreach ($languages as $l)
		{
			if ($l[0] == $language)
			{
				return $l[1];
			}
		}
		
		return "";
	}
	
	function getAuthenticationMethod(){
		return $this->_settings["authentication"];
	}
	
	/**
	 * Devuelve la configuraci�n del manejo de errores definido en el archivo de configuraci�n
	 *
	 * @access public
	 * @return bool true si est� seteado, false en caso contrario
	 */
	function getErrorHandlerSetting()
	{
		if ($this->_settings["errorhandler"])
			return $this->_settings["errorhandler"];
			
		return false;
	}
	
	/**
	 * Procesa los tags correspondientes a internacionalizaci�n de la aplicaci�n. Carga la configuraci�n en
	 * variables de instancia de esta clase.
	 * 
	 * @access private
	 * @param object $dom referencia al objeto DOM del archivo de configuraci�n de la aplicaci�n
	 * @return void
	 */ 
	function _processI18N($dom)
	{
		// Un solo elemento <i18n>
		$i18n = $dom->getElementsByTagname('i18n')->item(0);

		// Archivos internacionalizaci�n
		$files = $i18n->getElementsByTagname('file');
		foreach ($files as $file)
		{
			// Nombre del archivo
			$filename = $file->firstChild->data;
			// El �nico atributo es language (Ejemplo: <file language="es">site_es.properties</file>)
			$value = $file->getAttributeNode("language")->value;
			// Grabar la configuraci�n
			$this->_settings["i18n"][] = array($value, $filename);
		}		
	}
	
	/**
	 * Procesa los tags correspondientes a internacionalizaci�n de la aplicaci�n. Carga la configuraci�n en
	 * variables de instancia de esta clase.
	 * 
	 * @access private
	 * @param object $dom referencia al objeto DOM del archivo de configuraci�n de la aplicaci�n
	 * @return void
	 */ 
	function _processAuthenticationMethod($dom)
	{
		$authentication = $dom->getElementsByTagname("authentication")->item(0);

		$value = $authentication->attributes->item(0)->firstChild->data;
			
		// Grabar la configuraci�n
		$this->_settings["authentication"] = $value;
	}
		
	/**
	 * Procesa los tags correspondientes a manejo de errores de la aplicaci�n. Carga la configuraci�n en
	 * variables de instancia de esta clase.
	 * 
	 * @access private
	 * @param object $dom referencia al objeto DOM del archivo de configuraci�n de la aplicaci�n
	 * @return void
	 */ 
	function _processSettings($dom)
	{
		// Procesar el elemento <errorhandler>
		$errorhandler = $dom->getElementsByTagname("errorhandler")->item(0)->firstChild->data;
		// Grabar la configuraci�n
		if ($errorhandler != ""){
			$bool = ($errorhandler == "true") ? true : false;
			$this->_settings["errorhandler"] = $bool;
		}
	}
}
?>