<?php
	// mysql_connect, mysql_ etcetera, deprecated
	class ClassConectar {
	public static function Conexion()
	{
		@$con = mysql_connect("localhost","root","");
		mysql_select_db("cdcol");
		mysql_query("SET NAMES 'utf-8'");
		return $con;
	}
}
class ClassDiscos
{
	private $discos;
	public function __construct()
	{
		$this->discos = array();
	}
	public function get_discos()
	{
		$sql = "SELECT * FROM cds";
		$result = mysql_query($sql,ClassConectar::Conexion());
		while($reg = mysql_fetch_assoc($result))
		{
			$this->discos[] = $reg;
		}
		return $this->discos;
	}
}
$discos = new ClassDiscos();
$registros = $discos->get_discos();
//echo var_dump($registros);
echo json_encode($registros);

/*for($i = 0; $i < sizeof($registros); $i++)
{
	echo '<tr><td>'.$registros[$i]['id'].'</td><td>'.$registros[$i]['titel'].'</td><td>'.$registros[$i]['interpret'].'</td><td>'.$registros[$i]['jahr'].'</td></tr>';
}
*/

?>