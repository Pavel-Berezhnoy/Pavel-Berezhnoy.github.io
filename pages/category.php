<div class="content wrapper-inner">
    <?php require_once 'php/get-category.php';
    $rows = mysqli_num_rows($result);
    for ($i=0; $i < $rows; $i++) {
        $row = mysqli_fetch_row($result);
        $query2 ='SELECT id_post,img,name FROM posts WHERE id_cat="'.$row[0].'" LIMIT 4 ';
        $result2 = mysqli_query($GLOBALS['link'], $query2) or die("Ошибка " . mysqli_error($link));
        $rows2 = mysqli_num_rows($result2);
        echo (htmlspecialchars_decode('
       <div class="content-category_rows">
         <div class="content-category_title">
           <h2>'.$row[1].'</h2>
         </div>
         <div class="content-category_blocks">
           '));
        for ($j=0; $j < $rows2; $j++) {
            $row2 = mysqli_fetch_row($result2);
            echo (htmlspecialchars_decode('<div class="block-category-1_container"><div class="block-category-1">
               <a href="http://'.$_SERVER['HTTP_HOST'].'/новости/'.$row2[0].'">
                 <div class="block-category-1_content">
                   <div class="block-category-1_picture">
                     <img src="http://'.$_SERVER['HTTP_HOST'].'/upload/'.$row2[1].'" alt="">
                   </div>
                   <div class="block-1_info big-info">
                     <div class="block-category-1_title">
                       <h2><b>'.$row2[2].'</b></h2>
                     </div>
                   </div>
                 </div>
               </a>
             </div></div>'));
        }
        echo (htmlspecialchars_decode('
       </div>
       <div class="content-category_more-button">
           <a class="btn" href="http://'.$_SERVER['HTTP_HOST'].'/категории/'.$row[0].'">Ещё</a>
       </div>
     </div>'));

    }?>
</div>