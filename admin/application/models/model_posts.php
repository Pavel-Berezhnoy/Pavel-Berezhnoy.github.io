<?php
include "application/functions/page.php";

class Model_Posts extends Model
{
    public $data = array("posts" => array(), "pages", "current_page", "page_name", "page_name_base");
    public $offset;

    function __construct()
    {
        parent::__construct();
        //удаление постов
        $this->controller_delete();

        //определение смещения
        $this->offset = Page::getOffsetQuery();

        //определение текущей страницы
        $this->data["current_page"] = Page::getCurrentPage();
    }

    function get_data()
    {
        //получение постов
        $query = "SELECT name,posts.id_post as id_tmp, (SELECT COUNT(id_record) FROM records WHERE status='accept' AND id_post=id_tmp) AS 'members', posts.date  FROM posts LIMIT 10 OFFSET $this->offset";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $rows = mysqli_num_rows($result);
        for ($i = 0; $i < $rows; $i++) {
            $row = mysqli_fetch_row($result);
            array_push($this->data["posts"], array("name" => $row[0], "id" => $row[1], "members" => $row[2], "date" => $row[3]));
        }
        $query = "SELECT COUNT(*) FROM posts";
        $this->data["pages"] = Page::getCountPages($query);
        $this->data["page_name"] = "Мероприятия";
        return $this->data;
    }

    function controller_delete()
    {
        if (!empty($_GET['delete'])) {
            $this->delete_post($_GET['delete']);
        }
        if (!empty($_POST['posts']) && !empty($_POST['action'])) {
            $this->delete_posts($_POST['posts']);
        }
    }

    function delete_post($id)
    {
        $query = "DELETE FROM posts WHERE id_post='$id'";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
    }

    function delete_posts($array)
    {
        $query = "DELETE FROM posts WHERE ";
        for ($i = 0; $i < count($array); $i++) {
            if ($i == 0) {
                $query .= "id_post = $array[$i] ";
                continue;
            }
            $query .= "OR id_post= $array[$i] ";
        }
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
    }
    
}