<?php

//Database Wrapper untuk mengelola database aoapun pada model manapun
class Database {
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $db_name = DB_NAME;
	
	private $dbh;
	private $stmt;
	
	
	public function __construct()
	{
		//data source name
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
	 	
		//optimasi koneksi ke database
	 	$option = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];
		
		//test koneksi 
		try {
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
		} catch(PDOException $e){
			die($e->getMessage());
		}

  }
	
	//fungsi menjalankan query
	public function query($query)
	{
		$this->stmt = $this->dbh->prepare($query);		
	}	
	
		
	public function bind($param, $value, $type = null)
	{
		if( is_null($type) ) {
			switch( true ) {
				case is_int($value) : 
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value) :
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value) :
					$type = PDO::PARAM_NULL;
					break;
				default :
					$type = PDO::PARAM_STR;
			}
		}
		
		//bind data untuk menghindari mysql injeksi,karena query dieksekusi setelah stringnya dibersihkan
		$this->stmt->bindValue($param, $value, $type);
	}	
	
	//eksekusi data	
	public function execute()
	{
		$this->stmt->execute();
	}	
		
	//menampilkan banyak hasil
	public function resultSet()	
	{
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);		
	}
	
	//menampilkan satu data
	public function single()
	{
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	} 
	
	public function rowCount()
	{
		return $this->stmt->rowCount();
	}
	
}