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
	public function getLatestPost($limit=5, $offset=0)
	{
		return $this->db->query("select post.id, post.title, post.content, post.date, post.date_update, post.author_id, post.cat_id, post.image, user.name from post inner join user on post.author_id=user.id ORDER BY post.date DESC LIMIT ".$offset.", ".$limit);
	}
	public function createPost($postTitle, $postContent, $author_id, $image=false)
	{
		return $this->db->execute(
			"insert into post (title, content, author_id, image)
			values (?,?,?,?);", array($postTitle, $postContent, $author_id, $image));
	}
	public function erasePost($id)
	{
		return $this->db->execute(
			"delete from post
			WHERE id = ? ;", array($id));
	}
	public function getMaxPost()
	{
		$result = $this->db->queryOne("select count(id) as count from post");
		return $result['count'];
	}

}








