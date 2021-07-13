<?php

class Model_Post extends Model
{
    public $data;

    function create_post()
    {
        $this->data = array("name" => $_POST['name'], "date" => $_POST['date'], "description" => $_POST['description'],
            "categories", "place" => $_POST['place'], "id_cat" => $_POST['id_cat'], "result");
        $this->data["categories"] = $this->get_categories();
        if (count($_POST)==0){
            return $this->data;
        }
        //проверка на наличия всех полей
        if (empty($_POST['name']) || empty($_POST['date']) || empty($_POST['description']) || empty($_POST['place'])) {
            $this->data["result"] = array("status" => "fail", "description" => "Заполнены не все поля!");
            return $this->data;
        }
        //проверка существования поста
        $query = "SELECT name FROM posts WHERE name = '$this->data[name]'";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        if (mysqli_num_rows($result) != 0) {
            $this->data['result'] = array("status" => "fail", "description" => "Мероприятие с таким названием существует!");
            return $this->data;
        }
        //добавление поста

        $query = "INSERT INTO posts (name,date,id_cat,place) VALUES ('$_POST[name]','$_POST[date]',$_POST[id_cat],'$_POST[place]')";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $id_insert_record = mysqli_insert_id($this->link);
        $fp = fopen("$_SERVER[DOCUMENT_ROOT]/posts/$id_insert_record.html", 'w');
        fwrite($fp,$_POST['description']);
        fclose($fp);
        //добавление изображение к посту
        $this->update_img($id_insert_record);
        header("Location: https://$_SERVER[HTTP_HOST]/admin/post/change/?id_post=$id_insert_record");
    }
    function update_img($id_post){
        if (!isset($_FILES) || $_FILES['image']['error'] !== 0) {
            return;
        }
        $ext = substr(strrchr($_FILES['image']['name'], '.'), 1);
        $new_name = uniqid('file_') . '.' . $ext;
        // Директория для размещения файла
        $destination_dir = "$_SERVER[DOCUMENT_ROOT]/upload/$new_name";
        // Перемещаем файл в желаемую директорию
        move_uploaded_file($_FILES['image']['tmp_name'], $destination_dir);
        $query = "UPDATE posts SET img='$new_name' WHERE id_post = $id_post";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
    }
    function change_post()
    {
        $id_post = $_GET['id_post'];
        $query = "SELECT id_post, name, id_cat,img, place, date FROM posts WHERE id_post='$id_post'";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $row = mysqli_fetch_row($result);
        $date = new DateTime($row[5]);
        $date = $date->format('Y-m-d\TH:i');
        $this->data = array("id_post" => $row[0], "name" => $row[1], "id_cat" => $row[2], "description" => "$_SERVER[DOCUMENT_ROOT]/posts/$id_post.html",
            "img" => $row[4], "place" => $row[4], "date" => "$date", "categories");
        $this->data["categories"] = $this->get_categories();
        if (count($_POST) != 0) {
            $this->update_post();
        }
        return $this->data;
    }

    function update_post()
    {
        $this->data = array("name" => $_POST['name'], "date" => $_POST['date'], "description" => "$_SERVER[DOCUMENT_ROOT]/posts/$_GET[id_post].html",
            "categories" => $this->get_categories(), "place" => $_POST['place'], "id_cat" => $_POST['id_cat']);
        $query = "UPDATE posts SET name = '$_POST[name]',id_cat = $_POST[id_cat],date='$_POST[date]',place='$_POST[place]' WHERE id_post=$_GET[id_post]";
        $fp = fopen("$_SERVER[DOCUMENT_ROOT]/posts/$_GET[id_post].html", 'w');
        fwrite($fp,$_POST['description']);
        fclose($fp);
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $this->update_img($_GET['id_post']);
    }

    function get_categories()
    {
        $query = "SELECT id_cat,name FROM category";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_row($result);
            array_push($data, array("id_cat" => $row[0], "name" => $row[1]));
        }
        return $data;
    }
}