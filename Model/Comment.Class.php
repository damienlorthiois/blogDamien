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
		return $this->db->query("select comment.*, user.name from comment inner join user on comment.author_id = user.id where post_id= ?", array($postId));
	}
	public function createComment($postId, $authorId, $commentContent)
	{
		return $this->db->execute(
			"insert into comment (post_id, author_id, content)
			values (?,?,?);", array($postId, $authorId, $commentContent));
	}
	public function eraseComment($id)
	{
		return $this->db->execute(
			"delete from comment
			WHERE id = ? ;", array($id));
	}
}








