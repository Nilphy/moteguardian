<?php

include_once BASE_DIR . 'clases/negocio/clase.Central.php';
include_once BASE_DIR . "clases/listados/clase.Listados.php";
include_once BASE_DIR . 'clases/dao/dao.Central.php';
include_once BASE_DIR . 'clases/dao/dao.CentralRecoleccionManual.php';
/**
 * @author aamantea
 */
class CentralDel extends Action {

	function procesar(&$nextAction){
		$central = new Central($_GET['id']);
		$central->load($_GET['id']);

		// Obtengo la recolecci�n a la que est� asociada la central
		$recoleccion = new Recoleccion($central->id_recoleccion);		 
		
		$centralRecManualDAO = new CentralRecoleccionManualDAO();
		$recoleccionesManuales = $centralRecManualDAO->filterByField("id_central",$_GET['id']);
		
		//Si no hab�a ninguna recolecci�n asociada a la central, se puede borrar
		if(count($recoleccionesManuales) == 0 && (!isset($central->id_recoleccion)||($recoleccion->baja_logica)||($recoleccion->temporal))) {
			$central->baja_logica = TRUE_;
			$res = $central->update($_GET['id']);	
		}
		
		if ($res) {
			$nextAction->setNextAction('CentralBuscar', 'central.eliminar.ok');
		} else {
			$nextAction->setNextAction('CentralBuscar', 'central.eliminar.error',array(error => "1"));
		}
	}
	
}

?>