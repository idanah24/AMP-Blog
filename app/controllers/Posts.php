<?php

class Posts extends Controller {

    private $postModel;
    private $userModel;

    public function __construct() {
        if (!isLoggedIn()) {
            redirect('/users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index() {
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    public function add() {

//        Get request
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data = [
                'title' => '',
                'body' => '',
                'title_err' => '',
                'body_err' => ''
            ];

            $this->view('posts/add', $data);
        } else {
//        Post request - form handling
//            Sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//        Get form data
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_err' => '',
                'body_err' => ''
            ];

//        Validate fields

            if (empty($data['title'])) {
                $data['title_err'] = 'Please specify title';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please fill in post content';
            }


//        Checking validation

            if (empty($data['title_err']) && empty($data['body_err'])) {
//            Valid form data
                $this->postModel->add($data);
                flash('post_added', 'Post added successfully');
                redirect('posts');
            } else {
                $this->view('posts/add', $data);
            }
        }
    }

    public function show($id) {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user
        ];
        $this->view('posts/show', $data);
    }

//    Edit existing post
    public function edit($id) {


        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//            Editing post
            $post = $this->postModel->getPostById($id);

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,
                'title_err' => '',
                'body_err' => ''
            ];

            $this->view('posts/edit', $data);
        } else {
//            Updating post

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//        Get form data
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_err' => '',
                'body_err' => ''
            ];

//        Validate fields

            if (empty($data['title'])) {
                $data['title_err'] = 'Please specify title';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please fill in post content';
            }

//        Checking validation

            if (empty($data['title_err']) && empty($data['body_err'])) {
//            Valid form data
                $this->postModel->edit($id, $data);
                flash('post_mod', 'Post modified successfully');
                redirect('posts');
            } else {
//                $this->view('posts/edit/' . $id, $data);
                redirect('posts/edit/' . $id);
            }
        }
    }

    
//    Delete post
    public function delete($id){
        $this->postModel->delete($id);
        redirect('posts');
        
    }
}
