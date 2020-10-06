<?php

class Users extends Controller {
    
   private $userModel;
    
    public function __construct() {
//        Creating user model
        $this->userModel = $this->model('User');
    }

    public function register() {

//        Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            Process form

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//            Get data from form, create data array
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'confirm_password' => $_POST['confirm_password'],
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

//            Form validation
//            Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            //            Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
//                Checking if email already exists
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'This email already exists';
                }
            }

            //            Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } else {
                if (strlen($data['password']) < 6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                }
            }

            //            Validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else if ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Passwords do not match';
            } else {
                
            }
            
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_email_err'])) {
//                    Form Valid
                
//                Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                
//                Register user
                if($this->userModel->register($data)){
                    flash('register_success', 'You are registered and can now log in');
                    redirect('users/login');
                }
                else{
                    die('Something went wrong...');
                }
            }
            else{
//                Form Invalid,
                $this->view('users/register', $data);
                
                
            }
        }
//        Get Request
//        Init data
        $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
        ];

//        Load view
        $this->view('users/register', $data);
    }

    public function login() {

//        Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            Process form
            
//            Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //            Get data from form, create data array
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'email_err' => '',
                'password_err' => '',
            ];

//            Form validation
//            Validate name
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } 

            //            Validate email
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } 
            
            if(empty($data['email_err']) && empty($data['password_err'])){
//                Attempting log in
                $user = $this->userModel->login($data);
                if($user){
//                    Log in successfull
                    $this->createUserSession($user);
                    redirect('pages/index');
                }
                else{
//                    Failed log in
                    flash('login_failed', 'Incorrect user email / password', 'alert alert-danger');
                    $this->view('users/login', $data);
                }
            }
            
            else{
                $this->view('users/login', $data);
                
            }
            
            
        }
//        Init data
        $data = [
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => ''
        ];

//        Load view
        $this->view('users/login', $data);
    }

//    Creating session for logged in user
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
    }
    
//    Logging out
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }
    
//    Checking if there is a user connected
    public function isLoggedIn(){
        return isset($_SESSION['user_id']);
    }

}
