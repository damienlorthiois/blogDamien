<?php

class Model_Comment
{
	public $db;
	
	function __construct()
	{
		$this->db = new Helper_Database();
	}

	public function getNumberComment($postId)
	{
	
		$result = $this->db->queryOne("select count(id) as nbcomment from comment where post_id= ?", array($postId));
		return $result['nbcomment'];
	}
	public function getComment($postId)
	{
		return $this->db->query("select * from comment where post_id= ?", array($postId));
	}

}








