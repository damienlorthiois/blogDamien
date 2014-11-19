<?php

class Helper_Database
{
	private $db;

	public function __construct()
	{
		//aller chercher la configuration dans le .ini
		$config = new Helper_Config("config.ini");
		$user = $config->get("user", "database");
		$password = $config->get("password", "database");
		$dbname = $config->get("dbname", "database");

		//Instancier un nouvel objet PDO et le stocker dans $db
		$this->db = new PDO('mysql:host=localhost;dbname='.$dbname, $user, $password);
		$this->db->exec("SET NAMES UTF8");
	}

	public function query ($queryString, $data=array())
	{
		// prepare
		$query = $this->db->prepare($queryString);
		// execute
		$query->execute($data);
		//Fetch ALL
		return $query-> fetchAll(PDO::FETCH_ASSOC);
	}

	public function queryOne ($queryString, $data=array())
	{
		// prepare
		$query = $this->db->prepare($queryString);
		// execute
		$query->execute($data);
		//Fetch ALL
		return $query-> fetch(PDO::FETCH_ASSOC);
	}

	public function execute ($queryString, $data=array())
	{
		// prepare
		$query = $this->db->prepare($queryString);
		// execute
		$query->execute($data);
		return $this->db>lastInsertId();
	}

}