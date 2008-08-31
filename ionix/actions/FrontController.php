<?php

/**
 * Canaliza todos los pedidos a la aplicaci�n y despacha a la acci�n correspondiente.
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
class FrontController
{
	/**
	 * Inicializa el regitro y dem�s configuraciones necesarias para la aplicaci�n
	 *
	 * @access public
	 * @return FrontController
	 */
	function FrontController()
	{
		session_start();
		
		// Setear el error handler
		$instance = AppConfiguration::getInstance();		
		if ($instance->getErrorHandlerSetting())
		{
			$handler = new ErrorHandler();
		}
		
		// Inicializar registro
		if (! RegistryHelper::isInit())
			RegistryHelper::init();
	}
	
	/**
	 * Despacha a la acci�n correspondiente al request. Luego de la ejecuci�n devuelve la referencia a la
	 * acci�n.
	 *
	 * @access public
	 * @return (object) referencia a la acci�n creada
	 */
	function dispatch()
	{
		// Tomar la accion que viene por GET
		$action = $_GET['accion'];
	
	    // Buscar el path de la clase para la accion correspondiente o un path por defecto
	    $actionFactory = new ActionFactory($action);
	    $actionParams = $actionFactory->create();
	    $class_name = $actionParams['clase'];
	    $modulo = $actionParams['modulo'];
	    $action_name = $actionParams['nombre'];
	    
	    // Incluir el archivo con la clase
		include_once 'acciones/' . $modulo . '/accion.' . $class_name . '.php';
	
		// Crear la clase de la accion correspondiente
		eval('$action = new $class_name;');
	
		$action->ejecutarCiclo();
		
		return $action;
	}
}
?>