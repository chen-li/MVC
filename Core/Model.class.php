<?php
class Model{
	protected $dbLink = NULL;
	
	/**
	 * connect to DB
	 * @access public
	 * @return void
	 */
	public function __construct(){
		global $C;
		$this->dbLink = mysql_connect($C['DB_HOST'], $C['DB_USER'], $C['DB_PWD']) or exit(mysql_error());
		mysql_select_db($C['DB_NAME'], $this->dbLink) or exit(mysql_error());
		mysql_query('SET NAMES '.$C['DB_CHAR']);
	}
	
	/**
	 * excute sql query
	 * @access public
	 * @param string $sql
	 * @return resource
	 */
	public function Query($sql){
		$res = mysql_query($sql) or exit(mysql_error());
		return $res;
	}
	
	/**
	 * execute sql query and return whether success or not
	 * @param $sql
	 * @return bool
	 */
	public function Execute($sql){
		if(mysql_query($sql)){
			return true;
		}
		return false;
	}
	
	/**
	 * return the result of the excution of sql
	 * @param $res
	 * @param $type
	 * @return mixed
	 */
	public function Fetch($res, $type='array'){
		$func = ($type == 'array')?'mysql_fetch_array':'mysql_fetch_object';
		$row = $func($res);
		return $row;
	}
}
?>