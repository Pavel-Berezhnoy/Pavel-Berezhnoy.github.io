<?php

class Model_Main extends Model
{
    function __construct()
    {
        parent::__construct();

    }
    public $data = array();
    function get_data()
    {
        $query = "SELECT count(*) FROM records";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $data["record_count"] = mysqli_fetch_row($result)[0];
        $query = "SELECT count(*) FROM posts";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $data["post_count"] = mysqli_fetch_row($result)[0];
        $query = "SELECT count(*) FROM records WHERE status = 'waiting'";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $data["record_wait_count"] = mysqli_fetch_row($result)[0];
        return $data;
    }

    function get_chartPoint()
    {
        $date = new DateTime();
        $date->sub(new DateInterval("P10D"));
        $date = $date->format("Y-m-d");
        $query = "SELECT date as date_tmp, (SELECT COUNT(*) FROM records WHERE date = date_tmp) as count  FROM records WHERE date >= $date GROUP BY date";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $data = array();
        for ($i = 0;$i < mysqli_num_rows($result);$i++){
            $row =mysqli_fetch_row($result);
            array_push($data,array("date"=>$row[0],"count"=>$row[1]));
        }
        return json_encode($data);
    }
}