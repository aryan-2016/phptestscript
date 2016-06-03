<?php
class DbPdoClass
{
	private $dbHost;
	private $dbUserName;
	private $dbPassword;
	private $dbName;
	private $dbPort;
	private $dbConnection;
	private $dbStatement;
	
	public function __construct()
	{
		try
		{
			/*$options = array(
								PDO::ATTR_PERSISTENT    => true,
								PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
							);
			//$this->dbConnection = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbUserName, $this->dbPassword, $options);
			$dsn = 'pgsql:host=' . $this->dbHost . ';port=' . $this->dbPort . ';dbname=' . $this->dbName . ';user=' . $this->dbUserName . ';password=' . $this->dbPassword;
			$this->dbConnection = new PDO($dsn);*/
			
			$this->dbConnection = new PDO('pgsql:dbname=;host=;port=5432;user=;password=');
			$this->dbConnection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
		}
		catch(Exception $ex)
		{
			die("error: connection failed" . $ex->getMessage());
		}
	}
	
	public function closeDbConnection()
	{
		$this->dbConnection = null;
	}
	public function prepareQuery($dbQuery)
	{
		$this->dbStatement = $this->dbConnection->prepare($dbQuery);		
	}
	
	public function bindQueryValue($param, $value, $type = null)
	{
		if(is_null($type))
		{
			switch(true)
			{
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
					break;
			}
		}
		$this->dbStatement->bindValue($param, $value, $type);
	}
	
	public function executeQuery()
	{
		return $this->dbStatement->execute();
	}
	
	public function fetchResultset()
	{
		$this->executeQuery();
		return $this->dbStatement->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function fetchSingleRow()
	{
		$this->executeQuery();
		return $this->dbStatement->fetch(PDO::FETCH_ASSOC);
	}
	
	public function rowCount()
	{
		return $this->dbStatement->rowCount();
	}
	
	public function lastInsertId()
	{
		return $this->dbConnection->lastInsertId();
	}
	
	public function beginTransaction()
	{
		return $this->dbConnection->beginTransaction();
	}
	public function endTransaction()
	{
		return $this->dbConnection->commit();
	}
	public function cancelTransaction()
	{
		return $this->dbConnection->rollBack();
	}
}
