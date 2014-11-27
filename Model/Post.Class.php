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
		return $this->db->query(
			"select post.id, post.title, SUBSTR(post.content,1,500) as content, post.date, post.date_update, post.author_id, post.cat_id, post.image, user.name 
			from post 
			inner join user 
			on post.author_id=user.id 
			ORDER BY post.date DESC 
			LIMIT ".$offset.", ".$limit);
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
	public function editPost($postTitle, $postContent, $author_id, $postId)
	{
		return $this->db->execute(
			"update post
			SET title = ?, content=?, author_id=?
			Where id = ?;", array($postTitle, $postContent, $author_id, $postId));
	}
	public function editPostPicture($image=false, $postId)
	{
		return $this->db->execute(
			"update post
			SET image=?
			Where id = ?;", array($image, $postId));
	}
	public function getMaxPostWithTag($tagContent)
	{
		$result = $this->db->queryOne(
			"select count(post.id) as count 
			from post
			inner join tag
			on post.id = tag.post_id
			where tag.content = ?
			;",array($tagContent));
		return $result['count'];
	}
	public function getLatestPostWithTag($tagContent, $offset=0, $limit=5)
	{
		return $this->db->query(
			"select post.id, post.title, SUBSTR(post.content,1,500) as content, post.date, post.date_update, post.author_id, post.cat_id, post.image, user.name, tag.content as tagContent 
			from post
			inner join tag
			on post.id = tag.post_id
			inner join user 
	 		on post.author_id=user.id 
			where tag.content = ?
			ORDER BY post.date DESC 
			LIMIT ".$offset.", ".$limit
			.";",array($tagContent));
	}
}








