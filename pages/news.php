<div class="content wrapper-inner">
    <div class="content-picker">
        <div class="content-picker_items">
            <img src="images/list-ul.svg" alt="" onclick="ContentSizeBig()">
            <img src="images/grid-3x3.svg" alt="" onclick="ContentSizeSmall()">
        </div>
    </div>
    <div class="content_main-title">
        <h2>
            Свежие новости
        </h2>
    </div>
    <div class="content_rows">
        <?php require_once  'assets/news.php'?>
    </div>
</div>