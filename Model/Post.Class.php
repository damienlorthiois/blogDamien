<?php

class Model_Post
{
	public $db;
	
	function __construct()
	{
		$this->db = new Helper_Database();
	}

	public function getPost($id)
	{
		return $this->db->queryOne("select * from post WHERE id = ?", array($id));
	}
	public function getLatestPost()
	{
		return $this->db->query("select * from post ORDER BY date DESC LIMIT 5");
	}

}








