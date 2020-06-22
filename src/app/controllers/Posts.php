<?php
    class Posts extends Controller {

        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }
            // Load the post model
            $this->postModel = $this->model('Post');
            // Load the user model
            $this->userModel = $this->model('User');
        }

        public function index(){
            // Get posts
            $posts = $this->postModel->getPosts();
            $data = [
                'posts' => $posts
            ];

            $this->view('posts/index', $data);
        }

        public function add(){
            // Check for POST request
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize the post array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title'       => trim($_POST['title']),
                    'body'        => trim($_POST['body']),
                    'user_id'     => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_err'    => ''
                ];

                // Validate title
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter a title';
                }

                // Validate body
                if(empty($data['body'])){
                    $data['body_err'] = 'Please enter body text';
                }

                // Make sure errors are empty
                if(empty($data['title_err']) && empty($data['body_err'])) {
                    // Validated
                    if($this->postModel->addPost($data)){
                        flash('post_message', 'Post Added');
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    $this->view('posts/add', $data);
                }

            } else {
                $data = [
                    'title' => '',
                    'body'  => ''
                ];
            }
            $this->view('posts/add', $data);
        }

        public function edit($id){
            // Check for POST request
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize the post array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id'          => $id,
                    'title'       => trim($_POST['title']),
                    'body'        => trim($_POST['body']),
                    'user_id'     => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_err'    => ''
                ];

                // Validate title
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter a title';
                }

                // Validate body
                if(empty($data['body'])){
                    $data['body_err'] = 'Please enter body text';
                }

                // Make sure errors are empty
                if(empty($data['title_err']) && empty($data['body_err'])) {
                    // Validated
                    if($this->postModel->updatePost($data)){
                        flash('post_message', 'Post Updated');
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    $this->view('posts/edit', $data);
                }

            } else {
                // Get existing post from model
                $post = $this->postModel->getPostById($id);
                // Check for owner
                if($post->user_id != $_SESSION['user_id']){
                    redirect('posts');
                }

                $data = [
                    'id'    => $id,
                    'title' => $post->title,
                    'body'  => $post->body
                ];
            }
            $this->view('posts/edit', $data);
        }

        public function show($id){
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);
            $data = [
                'post' => $post,
                'user' => $user
            ];
            $this->view('posts/show', $data);
        }

        public function delete($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Get existing post from model
                $post = $this->postModel->getPostById($id);

                // Check for owner
                if($post->user_id != $_SESSION['user_id']){
                    redirect('posts');
                }

                if($this->postModel->deletePost($id)){
                    flash('post_message', 'Post Removed');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                redirect('posts');
            }
        }
    } // End posts class