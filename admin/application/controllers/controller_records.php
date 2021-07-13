<?php

class Controller_Records extends Controller
{
    function __construct()
    {
        $this->model = new Model_Records();
        $this->view = new View();
    }

    function action_index()
    {
        $this->action_all();
    }
    
    function action_all()
    {
        $data = $this->model->get_data_all();
        $this->view->generate("records_view.php","template_view.php",$data);
    }
    function action_wait(){
        $data = $this->model->get_data_wait();
        $this->view->generate("records_view.php","template_view.php",$data);
    }
    function action_accept(){
        $data = $this->model->get_data_accept();
        $this->view->generate("records_view.php","template_view.php",$data);
    }
    function action_denied(){
        $data = $this->model->get_data_denied ();
        $this->view->generate("records_view.php","template_view.php",$data);
    }
}