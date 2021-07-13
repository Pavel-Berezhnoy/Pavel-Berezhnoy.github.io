<?php
require_once "php/get-profile.php";
require_once "php/check-login.php";
$view_mode = false;
$email = $_COOKIE["Email"];
if ($_GET["email"]){
    view_mode_start();
}
function view_mode_start(){
    if (CheckAdmin()) {
        $GLOBALS["view_mode"] = true;
        if (isset($_GET["email"])) {
            $GLOBALS["email"] = $_GET["email"];
        }
    }
}

function getAvatar($data,$email)
{
    if (!empty($data["user"]["avatar"])) {
        return "https://$_SERVER[HTTP_HOST]/users_files/$email/моя_фотография/" . $data["user"]["avatar"];
    } else return "https://$_SERVER[HTTP_HOST]/images/AvatarNotFound.svg";
}

?>
<div class="profile wrapper-inner">
    <form class="profile-content" name="loadImage" id="loadImage">
        <div class="profile-content_top">
            <div class="profile-avatar_column">
                <div class="profile-avatar">
                    <?php if (!$view_mode): ?>
                        <input id="profile-avatar_img-add" type="file" name="avatar">
                        <label class="profile-avatar_img-add-button" for="profile-avatar_img-add">
                            <span>Изменить</span>
                        </label>
                    <?php endif; ?>
                    <img class="img-opening avatar_img" src="<?php echo getAvatar($data,$email); ?>" alt="">
                </div>
                <?php if (!$view_mode): ?>
                    <div class="profile_change-profile btn" onclick="profileChangeBlock()">
                        <span>Настроить</span>
                        <svg width="16" height="16" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.5178 1.71656C20.2578 0.458736 18.2173 0.458736 16.9572 1.71656L15.8156 2.86443L3.66325 15.0103L3.63742 15.0364C3.63117 15.0426 3.63117 15.0493 3.62451 15.0493C3.6116 15.0686 3.59223 15.0878 3.57952 15.1072C3.57952 15.1136 3.57286 15.1136 3.57286 15.1201C3.55995 15.1395 3.55369 15.1524 3.54058 15.1717C3.53432 15.1782 3.53432 15.1845 3.52786 15.1911C3.52141 15.2105 3.51495 15.2234 3.50829 15.2428C3.50829 15.249 3.50204 15.249 3.50204 15.2557L0.805797 23.3636C0.726703 23.5944 0.78683 23.85 0.960554 24.0213C1.08262 24.1418 1.24727 24.2092 1.41857 24.2086C1.48858 24.2074 1.55799 24.1965 1.62498 24.1763L9.72661 21.4736C9.73287 21.4736 9.73287 21.4736 9.73953 21.4673C9.75991 21.4613 9.77948 21.4526 9.79744 21.4413C9.80248 21.4407 9.80692 21.4385 9.81055 21.4351C9.82972 21.4221 9.85555 21.409 9.87492 21.3961C9.89408 21.3834 9.91365 21.364 9.93302 21.3511C9.93948 21.3445 9.94574 21.3445 9.94574 21.3382C9.95239 21.3317 9.96531 21.3255 9.97176 21.3124L23.2657 8.01842C24.5236 6.75837 24.5236 4.71788 23.2657 3.45803L21.5178 1.71656ZM9.52021 19.9577L5.03084 15.4685L16.2672 4.23222L20.7565 8.72138L9.52021 19.9577ZM4.3985 16.6618L8.32049 20.5836L2.43125 22.5444L4.3985 16.6618ZM22.3564 7.1153L21.6726 7.80555L17.183 3.31599L17.8734 2.62594C18.6287 1.87132 19.8528 1.87132 20.6082 2.62594L22.3626 4.38032C23.1122 5.13897 23.1094 6.36028 22.3564 7.1153Z"
                                  fill="white"/>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>
            <div class="profile_change-block">
                <div class="profile_change-block-header">
                    <img class="profile_change-block-close" src="../images/denied.svg"
                         onclick="profileChangeBlockClose()" alt="">
                    <span class="profile_change-block-title">Изменить</span>
                    <img class="profile_change-block-apply" src="../images/accept.svg" onclick="uploadProfileData()"
                         alt="">
                </div>
                <div class="profile_change-block-content">
                    <div class="profile_change-block-fio">
                        <input id="change_name" type="text" placeholder="Имя"
                               value="<?php echo ($data['user']["name"]=="Не указано")?"":$data['user']["name"] ?>">
                        <input id="change_surname" type="text" placeholder="Фамилия"
                               value="<?php echo ($data['user']["surname"]=="Не указано")?"":$data['user']["surname"] ?>">
                    </div>
                    <div><input id="change_phone" type="text" placeholder="Телефон"
                                value="<?php echo ($data['user']['number']=="Не указано")?"":$data['user']["number"]; ?>"></div>
                    <div><input id="change_birthdate" type="date" value="" placeholder="Дата рождения"></div>
                    <textarea style="min-height: 120px" placeholder="О себе" name=""
                              id="change_description"><?php echo ($data['user']['about']=="Не указано")?"":$data['user']["about"];; ?></textarea>
                </div>
                <div class="profile_change-block-footer">
                    <div class="profile_change-block-dots"></div>
                    <div class="profile_change-block-dots"></div>
                    <div class="profile_change-block-dots"></div>
                </div>
            </div>
            <div class="profile-description">
                <h2 class="profile-name">
                    <?php echo $data['user']["name"] . " " . $data['user']['surname']; ?>
                </h2>
                <div class="profile-about">
                    <p><span>О себе: </span> <span><?php echo $data['user']['about']; ?></span>
                    </p>
                </div>
                <div class="profile-about_arrow">
                    <svg width="20" height="14" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.49995 7.30952C8.19528 7.30952 7.89064 7.42585 7.65836 7.65803L0.34874 14.9677C-0.116247 15.4327 -0.116247 16.1866 0.34874 16.6514C0.813539 17.1162 1.56729 17.1162 2.03231 16.6514L8.49995 10.1834L14.9676 16.6512C15.4326 17.116 16.1863 17.116 16.6511 16.6512C17.1163 16.1864 17.1163 15.4325 16.6511 14.9675L9.34155 7.6578C9.10915 7.42559 8.80451 7.30952 8.49995 7.30952Z"
                              fill="#585855"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="profile-content_middle">
            <div class="profile-birth-date">
                <span>Дата рождения: </span><span><?php echo $data['user']['birthday'] ?></span>
            </div>
            <div class="profile-email">
                <span>Почта: </span><span><?php echo $email; ?></span>
            </div>
            <div class="profile-number">
                <span>Телефон: </span>
                <span><?php echo $data['user']['number']; ?></span>
            </div>
        </div>
        <div class="profile-content_portfolio">
            <h2 class="profile_portfolio-title">
                Моё портфолио
            </h2>
            <h2 class="profile_portfolio-subtitle">Фотографии</h2>
            <div class="profile_portfolio-items">
                <?php if (!$view_mode): ?>
                    <div class="portfolio-item">
                        <input id="portfolio_img-add" type="file" multiple name="images[]" accept=".jpg,.png">

                        <label class="portfolio_img-add-button" for="portfolio_img-add">
                            <svg viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d)">
                                    <rect x="2" y="2" width="74" height="74" fill="white"/>
                                </g>
                                <rect x="37" y="27" width="4" height="24" fill="#585858"/>
                                <rect x="27" y="41" width="4" height="24" transform="rotate(-90 27 41)" fill="#585858"/>
                                <defs>
                                    <filter id="filter0_d" x="0" y="0" width="78" height="78"
                                            filterUnits="userSpaceOnUse"
                                            color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                                       values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                                        <feOffset/>
                                        <feGaussianBlur stdDeviation="1"/>
                                        <feColorMatrix type="matrix"
                                                       values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.4 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow"
                                                 result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                        </label>
                    </div>
                <?php endif; ?>
                <?php foreach ($data['images'] as $src): ?>
                    <div class="portfolio-item" style="">
                        <img class="img-opening slider-item"
                             src="<?php echo "https://$_SERVER[HTTP_HOST]/users_files/$email/моё_портфолио/$src" ?>"
                             alt="">
                    </div>
                <?php endforeach; ?>
                <div class="img-opening_background"></div>
                <div class="img-opening_big-img">
                    <div class="img-opening_big-img-content">
                        <div class="opening-img_arrow-left" onclick="slider_back()">
                            <svg width="24" height="38" viewBox="0 0 12 19" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0)">
                                    <path d="M1.31009 9.52102C1.31084 9.82569 1.42792 10.13 1.66067 10.3618L8.98835 17.6533C9.45448 18.1172 10.2084 18.1153 10.672 17.6492C11.1357 17.1832 11.1338 16.4295 10.6679 15.9656L4.18394 9.51394L10.6358 3.03034C11.0994 2.56421 11.0976 1.81054 10.6316 1.34693C10.1657 0.882861 9.41179 0.884719 8.94795 1.35108L1.6563 8.67857C1.42466 8.91154 1.30934 9.21646 1.31009 9.52102Z"
                                          fill="#585855"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="17" height="10" fill="white"
                                              transform="matrix(-0.00246407 -0.999997 -0.999997 0.00246407 11.0215 17.9971)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="opening-img_arrow-right" onclick="slider_next()">
                            <svg width="24" height="38" viewBox="0 0 12 19" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0)">
                                    <path d="M10.6913 9.49697C10.6905 9.1923 10.5733 8.88797 10.3405 8.65629L3.01171 1.36587C2.5455 0.902104 1.79161 0.904081 1.32803 1.37029C0.86445 1.8363 0.866427 2.59005 1.33244 3.05385L7.8174 9.50451L1.3666 15.9891C0.903018 16.4553 0.904995 17.209 1.37101 17.6725C1.83703 18.1365 2.59092 18.1346 3.05469 17.6681L10.3452 10.3395C10.5768 10.1065 10.6921 9.80153 10.6913 9.49697Z"
                                          fill="#585855"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="17" height="10" fill="white"
                                              transform="matrix(0.00262274 0.999997 0.999997 -0.00262274 0.978516 1.02246)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>

                    </div>
                    <?php if (!$view_mode): ?>
                        <div class="img-opening_img-menu" onclick="deleteImage()"><span>Удалить</span></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="profile_portfolio-arrow">
                <svg width="20" height="14" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.49995 9.69048C8.19528 9.69048 7.89064 9.57415 7.65836 9.34197L0.34874 2.03228C-0.116247 1.56729 -0.116247 0.813398 0.34874 0.348599C0.813539 -0.1162 1.56729 -0.1162 2.03231 0.348599L8.49995 6.81662L14.9676 0.348825C15.4326 -0.115974 16.1863 -0.115974 16.6511 0.348825C17.1163 0.813624 17.1163 1.56752 16.6511 2.03251L9.34155 9.3422C9.10915 9.57441 8.80451 9.69048 8.49995 9.69048Z"
                          fill="#585855"/>
                </svg>
            </div>
            <h2 class="profile_portfolio-subtitle">Файлы</h2>
            <div class="profile_portfolio-items">
                <?php if (!$view_mode): ?>
                    <div class="portfolio-item">
                        <input id="portfolio_document-add" type="file" multiple name="files[]" accept=".pdf,.docx">
                        <label class="portfolio_img-add-button" for="portfolio_document-add">
                            <svg viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d)">
                                    <rect x="2" y="2" width="74" height="74" fill="white"/>
                                </g>
                                <rect x="37" y="27" width="4" height="24" fill="#585858"/>
                                <rect x="27" y="41" width="4" height="24" transform="rotate(-90 27 41)" fill="#585858"/>
                                <defs>
                                    <filter id="filter0_d" x="0" y="0" width="78" height="78"
                                            filterUnits="userSpaceOnUse"
                                            color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                                       values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                                        <feOffset/>
                                        <feGaussianBlur stdDeviation="1"/>
                                        <feColorMatrix type="matrix"
                                                       values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.4 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow"
                                                 result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                        </label>
                    </div>
                <?php endif; ?>
                <?php foreach ($data['files'] as $file): ?>
                    <div class="portfolio-item portfolio_document-items">
                        <?php if (!$view_mode): ?>
                            <div class="porfolio_document-remove"></div>
                        <?php endif; ?>
                        <a class="portfolio_document" data-filename="<?php echo $file[name]?>" href="<?php echo "https://$_SERVER[HTTP_HOST]/users_files/$email/мои_файлы/$file[name]"?>" download="">
                            <?php if ($file['type'] == 'docx'): ?>
                                <img src="<?php echo "https://$_SERVER[HTTP_HOST]/images/logo-docx.png"?>" alt="" style="object-fit: contain;">
                                <div class="portfolio_document-text portfolio_document-text_blue">
                                    <span><?php echo $file['name']?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($file['type'] == 'pdf'): ?>
                                <img src="<?php echo "https://$_SERVER[HTTP_HOST]/images/logo-pdf.png"?>" alt="" style="object-fit: contain;">
                                <div class="portfolio_document-text portfolio_document-text_red">
                                    <span><?php echo $file['name']?></span>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="profile_portfolio-arrow">
                <svg width="20" height="14" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.49995 9.69048C8.19528 9.69048 7.89064 9.57415 7.65836 9.34197L0.34874 2.03228C-0.116247 1.56729 -0.116247 0.813398 0.34874 0.348599C0.813539 -0.1162 1.56729 -0.1162 2.03231 0.348599L8.49995 6.81662L14.9676 0.348825C15.4326 -0.115974 16.1863 -0.115974 16.6511 0.348825C17.1163 0.813624 17.1163 1.56752 16.6511 2.03251L9.34155 9.3422C9.10915 9.57441 8.80451 9.69048 8.49995 9.69048Z"
                          fill="#585855"/>
                </svg>
            </div>
        </div>
        <div class="profile-content_bottom">
            <h2 class="profile_bottom-title">
                Заявки
            </h2>
            <div class="profile_blocks">
                <?php for ($i = 0; $i < count($data["records"]); $i++): ?>
                    <a href="<?php echo 'https://' . $_SERVER['HTTP_HOST']; ?>/новости/<?php echo $data["records"][$i]["id_post"] ?>"
                       class="profile_block-1">
                        <div class="profile_block-description">
                            <h2 class="profile_block-name"><?php echo $data["records"][$i]["name"] ?></h2>
                            <p class="profile_block-time">Дата и время проведения:
                                <br> <?php echo $data["records"][$i]["date"] ?></p>
                            <p class="profile_block-place">Место проведения:
                                <br><?php echo $data["records"][$i]["place"] ?></p>
                        </div>
                        <div class="profile_block-status">
                            <div class="profile_status-title">Статус:</div>
                            <?php if ($data["records"][$i]["status"] == "waiting"): ?>
                                <div class="profile_status-icon">
                                    <img src="../images/waiting.svg" alt="">
                                </div>
                            <?php elseif ($data["records"][$i]["status"] == "accept"): ?>
                                <div class="profile_status-icon">
                                    <img src="../images/accept.svg" alt="">
                                </div>
                            <?php elseif ($data["records"][$i]["status"] == "denied"): ?>
                                <div class="profile_status-icon">
                                    <img src="../images/denied.svg" alt="">
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    </form>
</div>
<script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/js/profile.js"></script>