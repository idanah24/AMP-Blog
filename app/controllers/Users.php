<?php

class Users extends Controller {

    public function __construct() {
        
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
            } else {
                
            }

            //            Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                
            }

            //            Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } else if (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            } else {
                
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
                die('Valid');
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
            } else {
                
            }

            //            Validate email
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } else {
                
            }
            
            if(empty($data['email_err']) && empty($data['password_err'])){
                
                die('validated');
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

}
