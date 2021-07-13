<?php
if (isset($segments[2])) {
    $id_post = $segments[2];
}
require_once 'php/connection.php';
require_once 'php/check-login.php';
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
$query = 'SELECT posts.img,posts.name,posts.description, category.name as category, posts.id_cat, posts.date, posts.place FROM posts LEFT JOIN category ON posts.id_cat = category.id_cat WHERE id_post="' . $id_post . '";';
$result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_row($result);
$id_cat = 'https://' . $_SERVER['HTTP_HOST'] . '/категории/' . $row[4];
$src_img = 'https://' . $_SERVER['HTTP_HOST'] . '/upload/' . $row[0];
$title = $row[1];
$description = "$_SERVER[DOCUMENT_ROOT]/posts/$id_post.html";
$category = $row[3];
$date = $row[5];
$place = $row[6];
$register_bool = false;
if (CheckLogin()) {
    $query = "SELECT id_record FROM records WHERE id_user=$_COOKIE[id_user] AND id_post=$id_post";
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
    if (mysqli_num_rows($result) != 0) {
        $register_bool = true;
    }
}
?>

<div class="post_content wrapper-inner">
    <div class="post_img">
        <img src="<?php echo($src_img) ?>" alt="">
    </div>
    <div class="post_description">
        <div class="post_category btn">
            <a href="<?php echo($id_cat) ?>">
                <h2><?php echo($category) ?></h2>
            </a>
        </div>
        <div class="post_title">
            <h2><?php echo($title) ?></h2>
        </div>
        <div class="post_text">
            <p><?php require_once $description;?></p>
        </div>
        <div class="post_information">
            <div class="post_clock">
                <img src="../images/clock.svg" alt="" class="post_clock-icon">
                <p class="post_clock-text"><?php echo $date; ?></p>
            </div>
            <div class="post_place">
                <img src="../images/place.svg" alt="" class="post_place-icon">
                <p class="post_place-text"><?php echo $place; ?></p>
            </div>
            <?php if ($register_bool == false): ?>
                <div class="button-signup btn" id="registerForTheEvent">
                    <span>Записаться</span>
                </div>
            <?php else: ?>
                <div class="button-signup_successful" id="registerForTheEvent">
                    <span>Заявка отправлена</span>
                </div>
            <?php endif; ?>
            <div class="post__errors">
                <span></span>
            </div>
        </div> 
    </div>
</div>
<script src="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . '/js/registerForTheEvent.js' ?>"></script>