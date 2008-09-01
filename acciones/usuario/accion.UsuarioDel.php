<?
include_once BASE_DIR ."clases/negocio/clase.Usuario.php";
include_once BASE_DIR ."clases/service/clase.Logger.php";
include_once BASE_DIR ."comun/defines_acciones_logger.php";

class UsuarioDel extends Action {
	var $tpl = "";
	
	function procesar(&$nextAction){
		$usuario = new Usuario($_GET['id']);
		$usuario->baja_logica = 1;
		
		if ($usuario->update()) {
			$nextAction->setNextAction("UsuarioBuscar", "eliminacion.usuario.ok");			
		}
		else {
			$nextAction->setNextAction("UsuarioBuscar", "eliminacion.usuario.error",array(error => "1"));	
		}
	}
}
?>