<?
class Guardia extends AbstractEntity
{
    /**
     * Nombre de la tabla sobre a la cual accede la clase
     * @access protected
     * @var string
     */
    var $_tablename = 'guardia';

    /**
     * Nombre de los campos, menos el campo id
     * @access protected
     * @var array
     */
    var $_fields = array
    (		    
		'descripcion' 		=> 'varchar',	
		'id_sala' 			=> 'int',
		'estado' 			=> 'int',
		'codigo_tarjeta'	=> 'varchar',	
    	'tipo' 				=> 'int'      
    );

    var $id;
    var $descripcion;
    var $id_sala;
    var $estado;
    var $codigo;
    var $tipo;
}
?>