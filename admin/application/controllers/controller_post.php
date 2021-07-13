<?php

class Controller_Post extends Controller
{
    function __construct()
    {
        $this->model = new Model_Post();
        $this->view = new View();
    }

    function action_index()
    {
        $this->action_create();
    }
    function action_create(){
        $data = $this->model->create_post();
        $this->view->generate("post_view.php","template_view.php",$data);
    }
    function action_change(){
        $data = $this->model->change_post();
        $this->view->generate("post_view.php","template_view.php",$data);
    }
}