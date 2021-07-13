<?php

class Controller_Category extends Controller
{
    function __construct()
    {
        $this->model = new Model_Category();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate("category_view.php", "template_view.php", $data);
    }

    function action_add()
    {
        $response = $this->model->add_category();
        echo $response;
    }
}