<?php

namespace app;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];
    
    public ?Database $database = null;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $index = strpos($_SERVER['REQUEST_URI'], '?');
        if($index){
            $url = substr($_SERVER['REQUEST_URI'], 0, $index);
        } else {
            $url = $_SERVER['REQUEST_URI'];
        }
        if(!$url){
            $url = '/';
        }
        
        if ($method === 'get') {
            $fn = $this->getRoutes[$url] ?? null;
        } else {
            $fn = $this->postRoutes[$url] ?? null;
        }
        if (!$fn) {
            echo 'Page not found';
            exit;
        }
        echo call_user_func($fn, $this);
    }
}