<?php
include "application/functions/page.php";

class Model_Category extends Model
{
    public $data = array("categories" => array(), "pages", "current_page", "page_name", "page_name_base");
    public $offset;

    function __construct()
    {
        parent::__construct();
        //контроллер удаления
        $this->controller_delete();

        //определение смещения
        $this->offset = Page::getOffsetQuery();

        //определение текущей страницы
        $this->data["current_page"] = Page::getCurrentPage();
    }

    function get_data()
    {
        $query = "SELECT name,id_cat as id_cat_temp,(SELECT COUNT(*) FROM posts WHERE posts.id_cat = id_cat_temp ) as posts_count FROM category LIMIT 10 OFFSET $this->offset";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $rows = mysqli_num_rows($result);
        for ($i = 0; $i < $rows; $i++) {
            $row = mysqli_fetch_row($result);
            array_push($this->data["categories"], array("id" => $row[1], "name" => $row[0], "posts_count" => $row[2]));
        }
        $query = "SELECT COUNT(*) FROM category";
        $this->data["pages"] = Page::getCountPages($query);
        return $this->data;
    }

    function add_category()
    {
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);
        $name_category = $data['name'];
        $query = "SELECT name FROM category WHERE name = '$name_category'";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        if (mysqli_num_rows($result) == 0) {
            $query = 'INSERT INTO category (name) VALUES ("' . $name_category . '")';
            $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
            return json_encode(array("result" => "success"));
        } else {
            return json_encode(array("result" => "fail", "description" => "Категория с таким именем существует"));
        }
    }
    function controller_delete(){
        if (!empty($_GET["delete"])){
            $this->delete_category($_GET["delete"]);
        }
        if(!empty($_POST["categories"])&& !empty($_POST["action"])){
            $this->delete_categories($_POST["categories"]);
        }
    }
    function delete_category($id){
        $query="DELETE FROM category WHERE id_cat=$id";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
    }
    function delete_categories($array){
        $query="DELETE FROM category WHERE ";
        for ($i=0;$i<count($array);$i++){
            if ($i==0){
                $query .= "id_cat = $array[$i] ";
                continue;
            }
            $query .= "OR id_cat= $array[$i] ";
        }
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
    }
}