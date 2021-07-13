<?php
class Model
{
    public $link;

    public function __construct(){
        $this->link = mysqli_connect('localhost','m90817so_base','oy2&Q1Nm','m90817so_base');
    }
    public function get_data()
    {
    }
}