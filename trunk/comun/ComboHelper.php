<?
include_once BASE_DIR ."clases/dao/dao.Usuario.php";
include_once BASE_DIR ."clases/dao/dao.Rol.php";   
include_once BASE_DIR ."clases/dao/dao.Sala.php";   


function ComboUsuario($first=true,$text='')
{
	$usuarioDAO = new UsuarioDAO();
	return PresentationUtil::getCombo($usuarioDAO->getAll("usuario"), "usuario",$first,$text);
}



function ComboRol($first=true,$text='')
{	
	$rolDAO = new RolDAO();
	return PresentationUtil::getCombo($rolDAO->getAll("descripcion"), "descripcion",$first,$text);
}



function ComboHoras()
{	
	for($i = 0; $i <= 23; $i++) {
		if($i<10){
			$luegoTransferencia["0".$i]="0".$i;			
		} else {
			$luegoTransferencia[$i]=$i;
		}
	}
	return $luegoTransferencia;
}



function ComboMinutos()
{	
	for($i = 0; $i <= 59; $i++) {
		if($i<10){
			$luegoTransferencia["0".$i]="0".$i;			
		} else {
			$luegoTransferencia[$i]=$i;
		}
	}
	return $luegoTransferencia;
}



function ComboDias()
{
	$luegoTransferencia = array (CONST_DIA_LUNES => CONST_DIA_LUNES,
								CONST_DIA_MARTES  => CONST_DIA_MARTES,
								CONST_DIA_MIERCOLES => CONST_DIA_MIERCOLES,
								CONST_DIA_JUEVES	=> CONST_DIA_JUEVES, 
								CONST_DIA_VIERNES => CONST_DIA_VIERNES, 
								CONST_DIA_SABADO  => CONST_DIA_SABADO,
								CONST_DIA_DOMINGO => CONST_DIA_DOMINGO);
	return $luegoTransferencia;		
}


function ComboTipoDispositivo()
{
    return array(	
    	0 				=> "Seleccione un tipo de dispositivo...",
		CONST_RFID 		=> "Lector RFID",
		CONST_MOTA 		=> "Sensor Mota de Polvo",
		CONST_CAMARA 	=> "C�mara");
}


function ComboEstadoDispositivo()
{
	return array(	
    	0 				=> "Seleccione un estado...",
		CONST_AVERIADO 	=> "Averiado",
		CONST_NUEVO 	=> "Nuevo",
		CONST_EN_ALARMA => "En alarma",
		CONST_EN_USO 	=> "En uso");
}


function ComboSala($first=true, $text='Seleccione una sala...'){    
    $salaDAO = new SalaDAO();
    return PresentationUtil::getCombo($salaDAO->getAll("descripcion"), "descripcion", $first, $text);
}
?>
