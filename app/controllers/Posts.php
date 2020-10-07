<?php

class Posts extends Controller {

    private $postModel;

    public function __construct() {
        if (!isLoggedIn()) {
            redirect('/users/login');
        }

        $this->postModel = $this->model('Post');
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

}
