<?php
class DbMysqliClass
{
	private $dbHost;
	private $dbUserName;
	private $dbPassword;
	private $databaseName;
	private $dbPort;
	private $dbConnection;
	
	public function __construct()
	{
		try
		{
			return new mysqli($this->dbHost, $this->dbUserName, $this->dbPassword, $this->databaseName);			
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
