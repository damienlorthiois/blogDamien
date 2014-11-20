<?php

class Model_User
{
	public $db;
	
	function __construct()
	{
		$this->db = new Helper_Database();
	}

	public function validMember($name, $password)
	{
		return $this->db->queryOne("select * from user WHERE name = ? and password = ?", array($name, sha1($password)));
	}

	public function creatNewMember($name, $mail, $password)
	{
		return $this->db->execute(
			"insert into user (name, mail, password)
				values (?,?,?);", array($name, $mail, sha1($password)));
	}
}








