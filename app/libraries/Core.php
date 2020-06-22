<?php
    /*
     * App Core Class
     * Creates URL & loads the core controller
     * URL format = /controller/methods/params
     */
    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod     = 'index';
        protected $params            = [];

        public function __construct(){
            // print_r($this->getUrl());
            $url = $this->getUrl();

            // Look in controllers for first value
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // if exists, set as current controller
                $this->currentController = ucwords($url[0]);
                // unset array 0 index
                unset($url[0]);
            }
            // Require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';
            // Instantiate controller class
            $this->currentController = new $this->currentController;
            // Check for second part of URL
            if(isset($url['1'])){
                // Check to see if method exists in controller
                if(method_exists($this->currentController, $url['1'])){
                    $this->currentMethod = $url['1'];
                    // unset url 1
                    unset($url['1']);
                }
            }
            // Get params
            $this->params = $url ? array_values($url) : [];
            //Call a callback with array params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    } // End class Core
