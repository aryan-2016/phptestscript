<?php
class DbMysqlClass
{
	private $dbHost;
	private $dbUserName;
	private $dbPassword;
	private $dbName;
	private $dbPort;
	private $dbConnection;
	
	public function __construct()
	{
		try
		{
			$this->dbConnection = mysql_connect($this->dbHost, $this->dbUserName, $this->dbPassword);
			mysql_select_db($this->dbName);					
		}
		catch(Exception $ex)
		{
			return "error: connection failed" . $ex->getMessage();
		}
	}
	
	public function closeDbConnection()
	{
		$this->dbConnection = null;
	}	
}
