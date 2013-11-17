<?php 

class Database {
	function __construct() {
		$connection = mysql_connect('localhost', 'root', 'mysqlpass') or die(mysql_error());
		$database = mysql_select_db('mydb', $connection) or die(mysql_error());
	}

	// Return all result rows from MySQL query
	function fetch_all($query) {
		$data = array();
		$result = mysql_query($query);
		while ($rows = mysql_fetch_assoc($result)) {
			$data[] = $rows;
		}
		return $data;
	}

	// Basic run query
	function run_query($query) {
		mysql_query($query) or die(mysql_error());
	}

	// Fetch single result from query
	function fetch_result($query) {
		$result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		return $row;
	}
}

?>