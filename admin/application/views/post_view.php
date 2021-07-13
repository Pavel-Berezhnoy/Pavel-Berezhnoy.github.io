<div class="content">
    <div class="content__title application__title">
        <span><?php echo (!empty($_GET)) ? "Обновить" : "Добавить"; ?> мероприятие </span>
    </div>
    <form class="add-post" action="" method="POST" enctype="multipart/form-data">
        <div class="add-post__button">
            <input class="add-post__button-upload application__button" type="submit" value="Опубликовать">
            <div class="add-post__errors"><span><?php echo $data['result']['description']; ?></span></div>
        </div>
        <div class="add-post__columns">
            <div class="add-post__column-1">
                <div class="add-post__item">
                    <h2 class="add-post__item-title">Заголовок</h2>
                    <input type="text" class="add-post__item-content" name="name" value="<?php echo $data['name']; ?>">
                </div>
                <div class="add-post__item">
                    <h2 class="add-post__item-title">Категория</h2>
                    <select class="add-post__item-content" name="id_cat" id="">
                        <?php foreach ($data['categories'] as $item): ?>
                            <option name=""
                                    value="<?php echo $item['id_cat']; ?>"
                                <?php echo ($data['id_cat'] == $item['id_cat']) ? "selected" : ""; ?>>
                                <?php echo $item['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="add-post__item">
                    <h2 class="add-post__item-title">Загрузить превью</h2>
                    <label for="add-post__preview">
                        <div class="application__button add-post__button-preview"><span>Превью</span></div>
                    </label>
                    <input type="file" id="add-post__preview" name="image" class="add-post__item-content"
                           style="display: none;">
                </div>
                <div class="add-post__item">
                    <h2 class="add-post__item-title">Время проведения</h2>
                    <input type="datetime-local" class="add-post__item-content" name="date"
                           value="<?php echo $data['date']; ?>">
                </div>
                <div class="add-post__item">
                    <h2 class="add-post__item-title">Место проведения</h2>
                    <input type="text" class="add-post__item-content" name="place"
                           value="<?php echo $data['place']; ?>">
                </div>
            </div>
            <div class="add-post__column-2">
                <div class="add-post__item">
                    <h2 class="add-post__item-title">Описание</h2>
                    <textarea id="" class="add-post__item-content"
                              name="description"><?php include $data['description']; ?></textarea>
                </div>
            </div>
        </div>
    </form>
</div>