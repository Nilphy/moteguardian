<?
/**
 * Clase helper para obtener las claves de internacionalizaci�n.
 * 
 * ----------------------------------------
 *      iOnix - PHP Framework - 2006
 * ----------------------------------------
 * Jorge Barbosa      <jmbarbosa@gmail.com>
 * Alejandro Molinari <amolinari@gmail.com>
 * ----------------------------------------
 * 
 * @version 1.0
 * @package presentation
 * @author jbarbosa
 * @author amolinari
 */ 
class PropertiesHelper
{
	/**
	 * Devuelve todas las claves de internacionalizaci�n
	 * 
	 * @access public
	 * @static
	 * @return (array) contiene todas las claves y valores de internacionalizaci�n
	 */ 
	function GetKeys()
	{
		// Guardar los valores entre llamadas a la funci�n
		static $keys = array();
		
		if (empty($keys))
		{		
			// Cargar el archivo de claves y armar un array con las claves
			$instance = AppConfiguration::getInstance();
			$filename = $instance->getLanguageFileName(RegistryHelper::getLanguage());
		
			// Obtener las claves de internacionalizaci�n
			$lines = file($filename);
			foreach ($lines as $line)
			{
				// Quitar espacios y tabulaciones
				$line = ltrim($line);
	
				// Si no es comentario
				if (strlen($line) > 0 && $line[0] != '#')
				{
					$values = explode('=', $line);
					$keys[$values[0]] = trim($values[1]);
				}
			}
		}
		
		return $keys;
	}
		
	/**
	 * Devuelve el valor para la clave de internacionalizaci�n especificada
	 * 
	 * @access public
	 * @static
	 * @return (string) devuelve el valor de internacionalizaci�n para la clave especificada o un Warning si no existe
	 */ 
	function GetKey($key)
	{
		$keys = PropertiesHelper::GetKeys();
		
		return (!empty($keys[$key])) ? $keys[$key] : 'WARN: ' . $key;
	}
}