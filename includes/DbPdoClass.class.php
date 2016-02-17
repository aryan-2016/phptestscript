<?php
class DbPdoClass
{
	private $dbHost; //= 'ec2-54-225-215-233.compute-1.amazonaws.com';
	private $dbUserName; //= 'nqdnablyxgieuj';
	private $dbPassword; //= 'sQ-7YLmKlugulMCY9RLM7Jg6O1';
	private $dbName; //= 'da8pn1bn2vbs8m';
	private $dbPort; //= '5432';
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
			
			$this->dbConnection = new PDO('pgsql:dbname=da8pn1bn2vbs8m;host=ec2-54-225-215-233.compute-1.amazonaws.com;port=5432;user=nqdnablyxgieuj;password=sQ-7YLmKlugulMCY9RLM7Jg6O1');
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
