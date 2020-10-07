<?php

class Post {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

//    Get posts with users merged on id's
    public function getPosts() {
        $this->db->query('SELECT *,
            posts.id as postId,
            users.id as userId,
            posts.created_at as postCreatedAt,
            users.created_at as userCreatedAt
            FROM posts
            INNER JOIN users
            ON posts.user_id = users.id
            ORDER BY posts.created_at DESC
            ');

        $results = $this->db->resultSet();
        return $results;
    }

//    Add a new post
    public function add($data) {

        $this->db->query('INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)');
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        $this->db->execute();
    }

}
