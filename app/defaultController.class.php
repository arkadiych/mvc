<?php

class DefaultController extends Controller{

    public function executeIndex() {
        $str = $this->view->renderView('helloWorld', array("text" => "hello world", "ar" => array("a",'b','c')));
        return new Response($str);

    }

    public function executeShow() {
        echo "Show world!";
    }

}