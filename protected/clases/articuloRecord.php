<?php
/**
 * Auto generated by prado-cli.php on 2013-05-14 02:38:19.
 */
class articuloRecord extends TActiveRecord
{
	const TABLE='articulo';

	public $ID_ARTICULO;
	public $ID_USUARIO;
	public $ID_UBICACION;
	public $ID_IMAGEN;
	public $NOMBRE_PRODUCTO;
	public $CATEGORIA;
	public $DESCRIPCION;
	public $FECHA_PUBLICACION;
	public $DISPONIBILIDAD;

	public static function finder($className=__CLASS__)
	{
		return parent::finder($className);
	}
}
?>