<div class="content">
    <div class="content__title application__title">
            <span>Категории </span>
        </div>
    <div class="content__columns">
        <form method="POST" action="" class="content__column-1">
            <h2 class="category__add-title">Добавить</h2>
            <div class="category__add-namefield"><span>Название</span></div>
            <div class="category__add-info">
                <input type="text" class="category__add-field">
                <input class="category__add-button application__button" onclick="AddCategory()" type="button" value="Применить">
            </div>
            <div><span class="category__errors"></span></div>
        </form>
        <form method="POST" action="" class="content__column-2">
        <div class="application__action">
            <select class="application__select" name="action" id="">
                <option value="">Действие</option>
                <option value="delete">Удалить</option>
            </select>
            <input class="application__button" type="submit" value="Применить">
        </div>
        <div class="application__blocks">
            <div class="application__blocks-header category__blocks-header">
                <div class="application__block-checkbox"><input name="header_records" type="checkbox" onclick="checkbox_active()"></div>
                <div class="application__block-event-name"><span>Категория</span></div>
                <div class="application__block-status"><span>Кол-во постов</span></div>
            </div>
                <?php foreach ($data['categories'] as $item): ?>
                <div class="application__block">
                    <div class="application__block-desktop category__blocks-desktop">
                        <div class="application__block-checkbox"><input class="checkboxes" type="checkbox" name="categories[]" value="<?php echo $item['id']; ?>"></div>
                        <div class="application__block-event-name">
                            <span><?php echo $item['name']; ?></span>
                            <ul class="application__sublist-action post__sublist-action">
                                <li><a href="<?php echo Page::getCurrentUrl()."?page=$data[current_page]&delete=$item[id]"?>">Удалить</a></li>
                            </ul>
                        </div>
                        <div class="application__mobile-menu-icon">
                            <span>
                                <svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                    <path d="M5.9901 6.52323C6.16932 6.52257 6.34826 6.45212 6.48438 6.31231L10.7681 1.91079C11.0406 1.63079 11.0389 1.17846 10.7644 0.900583C10.4899 0.622706 10.0466 0.62433 9.77405 0.904209L5.98378 4.79892L2.16508 0.9322C1.89054 0.654324 1.44721 0.655947 1.17484 0.935825C0.902213 1.2157 0.903869 1.66804 1.17854 1.94603L5.49428 6.31607C5.63149 6.4549 5.81094 6.52388 5.9901 6.52323Z" fill="#585855"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0">
                                    <rect width="10" height="6" fill="white" transform="matrix(-0.999993 0.00366093 0.00366093 0.999993 10.9688 0.690674)"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </span>
                        </div>
                        <div class="application__block-status"><span><?php echo $item['posts_count']; ?></span></div>
                    </div>
                    <div class="application__block-mobile">
                        <div class="application__block-mobile__status">
                            <div class="application__status-title">Кол-во постов</div>
                            <div class="application__status-text"><?php echo $item['posts_count']; ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php include "application/components/page_slider.php" ?>
    </form>
    </div>
</div>
<script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/admin/js/category.js"></script>