<?php
include "application/functions/page.php";
include "application/functions/mail.php";
class Model_Records extends Model
{
    public $data = array("records" => array(), "pages", "current_page", "page_name", "page_name_base");
    public $offset;
    function __construct()
    {
        parent::__construct();
        //изменение статусов
        $this->changeStatus();

        //определение смещения
        $this->offset = Page::getOffsetQuery();

        //определение текущей страницы
        $this->data["current_page"] = Page::getCurrentPage();

    }

    function get_data_all()
    {
        //получение заявок
        $query = "SELECT posts.name, users.email, posts.date, records.status, records.id_record FROM records LEFT JOIN posts ON records.id_post = posts.Id_post LEFT JOIN users ON users.id_user = records.id_user ORDER BY records.id_record DESC LIMIT 10 OFFSET $this->offset ";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));

        //добавление информации о заявках в дату
        $this->pushRecordsToData($result);

        //получение количества стриниц
        $query = "SELECT COUNT(*) FROM records";
        $this->data["pages"] = Page::getCountPages($query);
        $this->data["page_name"] = "Все";
        $this->data["page_name_base"] = "all";
        return $this->data;
    }

    function get_data_wait()
    {
        //получение заявок
        $query = "SELECT posts.name, users.email, posts.date, records.status, records.id_record FROM records LEFT JOIN posts ON records.id_post = posts.Id_post LEFT JOIN users ON users.id_user = records.id_user WHERE records.status = 'waiting' ORDER BY records.id_record DESC LIMIT 10 OFFSET $this->offset";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));

        //добавление информации о заявках в дату
        $this->pushRecordsToData($result);

        //получение количества стриниц
        $query = "SELECT COUNT(*) FROM records WHERE status='waiting'";
        $this->data["pages"] = Page::getCountPages($query);
        $this->data["page_name"] = "Ожидают";
        $this->data["page_name_base"] = "wait";
        return $this->data;
    }

    function get_data_accept()
    {
        //получение заявок
        $query = "SELECT posts.name, users.email, posts.date, records.status, records.id_record FROM records LEFT JOIN posts ON records.id_post = posts.Id_post LEFT JOIN users ON users.id_user = records.id_user WHERE records.status = 'accept' ORDER BY records.id_record DESC LIMIT 10 OFFSET $this->offset";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));

        //добавление информации о заявках в дату
        $this->pushRecordsToData($result);

        //получение количества стриниц
        $query = "SELECT COUNT(*) FROM records WHERE status='accept'";
        $this->data["pages"] = Page::getCountPages($query);
        $this->data["page_name"] = "Подтверждены";
        $this->data["page_name_base"] = "accept";
        return $this->data;
    }

    function get_data_denied()
    {
        //получение заявок
        $query = "SELECT posts.name, users.email, posts.date, records.status, records.id_record FROM records LEFT JOIN posts ON records.id_post = posts.Id_post LEFT JOIN users ON users.id_user = records.id_user WHERE records.status = 'denied' ORDER BY records.id_record DESC LIMIT 10 OFFSET $this->offset";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));

        //добавление информации о заявках в дату
        $this->pushRecordsToData($result);

        //получение количества стриниц
        $query = "SELECT COUNT(*) FROM records WHERE status='denied'";
        $this->data["pages"] = Page::getCountPages($query);
        $this->data["page_name"] = "Отказаны";
        $this->data["page_name_base"] = "denied";
        return $this->data;
    }

    //метод добавлеения записей в дату
    function pushRecordsToData($result)
    {
        $rows = mysqli_num_rows($result);
        for ($i = 0; $i < $rows; $i++) {
            $row = mysqli_fetch_row($result);
            if ($row[3] == "waiting")
                $status = "Ожидает";
            if ($row[3] == "accept")
                $status = "Подтверждена";
            if ($row[3] == "denied")
                $status = "Отказана";
            array_push($this->data["records"], array("post_name" => $row[0], "email" => $row[1], "post_date" => $row[2], "status" => $status, "id_record" => $row[4]));
        }
    }

    //изменение статуса
    function changeStatus(){
        if (isset($_GET["accept"])){
            $this->acceptRecord($_GET["accept"]);
        }
        if (isset($_GET["denied"])){
            $this->deniedRecord($_GET["denied"]);
        }
        if(!isset($_POST["records"])&& !isset($_POST["action"])){
            return;
        }
        if ($_POST["action"]=="accept"){
            $this->acceptRecords($_POST["records"]);
        }
        if ($_POST["action"]=="denied"){
            $this->deniedRecords($_POST["records"]);
        }
    }
    function acceptRecord($id){
        $query="UPDATE records SET status='accept' WHERE id_record = $id";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $this->send_mail($id);
    }
    function deniedRecord($id){
        $query="UPDATE records SET status='denied' WHERE id_record = $id";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
    }
    function acceptRecords($array){
        $query="UPDATE records SET status='accept' WHERE ";
        for ($i=0;$i<count($array);$i++){
            $this->send_mail($array[$i]);
            if ($i==0){
                $query .= "id_record = $array[$i] ";
                continue;
            }
            $query .= "OR id_record = $array[$i] ";
        }
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
    }
    function deniedRecords($array){
        $query="UPDATE records SET status='denied' WHERE ";
        for ($i=0;$i<count($array);$i++){
            if ($i==0){
                $query .= "id_record = $array[$i] ";
                continue;
            }
            $query .= "OR id_record = $array[$i] ";
        }
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
    }
    function send_mail($id_record){
        $query = "SELECT email, users.name, users.surname, records.id_post, posts.name FROM records LEFT JOIN users ON users.id_user = records.id_user LEFT JOIN posts ON posts.id_post = records.id_post WHERE records.id_record=$id_record";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $row = mysqli_fetch_row($result);
        $text = "Здравствуйте, $row[1] $row[2]! Вы утверждены на <a href='https://$_SERVER[HTTP_HOST]/новости/$row[3]'>$row[4]</a>>";
        Mail::send_mail($text,$row[0]);
    }
}