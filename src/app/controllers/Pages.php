<?php
    class Pages extends Controller {
        public function __construct(){
        }

        public function index(){
            if(isLoggedIn()){
                redirect('posts');
            }
            $data = [
                'title' => 'Simple Posts',
                'description' => 'Simple social network built on the S2MVC PHP framework'
            ];

            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title' => 'About Us',
                'description' => 'App to share simple posts with other users'
            ];
            $this->view('pages/about', $data);
        }
    }
