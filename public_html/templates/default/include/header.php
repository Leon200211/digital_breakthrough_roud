<?php

use engine\main\notificationSystem\controllers\Notification;

if(property_exists($this, 'notificationSystem') and $this->notificationSystem != null){
    $notice = $this->notificationSystem->getNotifications();
}else{
    $this->notificationSystem = Notification::getInstance();
    $notice = $this->notificationSystem->getNotifications();
}

//echo "<pre>";
//print_r($notice);
//echo "<pre>";
//exit();

?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            <img src="<?=SITE_URL?>templates/default/assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">ПСК ВЕСНА</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Поиск" title="Enter search keyword">
            <button type="submit" title="Search" disabled><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">
                        <?php
                            if(isset($notice)) echo count($notice);
                                else echo 0;
                        ?>
                    </span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        У вас
                        <?php
                        if(isset($notice)) echo count($notice);
                        else echo 0;
                        ?>
                        новых уведомления
                        <a href="/notification"><span class="badge rounded-pill bg-primary p-2 ms-2">Посмотреть все</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    
                    <?php foreach ($notice as $key => $n): ?>
                        <?php
                        if($key > 3) break;
                        ?>
                        <a href="<?=$n['path']?>" onclick="readNotification(<?=$n['id']?>, <?=$n['id_user']?>)">
                            <li class="notification-item">
                                <img src="<?=SITE_URL . '/files/notice/icon/' . $n['img']?>" width="24px;" style="margin-right: 10px;">
                                <div>
                                    <h4><?=$n['title']?></h4>
                                    <p><?=$n['note']?></p>
                                    <p><?=$n['date']?></p>
                                </div>
                            </li>
                        </a>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    <?php endforeach; ?>

<!--                    <li class="notification-item">-->
<!--                        <i class="bi bi-exclamation-circle text-warning"></i>-->
<!--                        <div>-->
<!--                            <h4>Lorem Ipsum</h4>-->
<!--                            <p>Quae dolorem earum veritatis oditseno</p>-->
<!--                            <p>30 min. ago</p>-->
<!--                        </div>-->
<!--                    </li>-->
<!---->
<!--                    <li>-->
<!--                        <hr class="dropdown-divider">-->
<!--                    </li>-->
<!---->
<!--                    <li class="notification-item">-->
<!--                        <i class="bi bi-x-circle text-danger"></i>-->
<!--                        <div>-->
<!--                            <h4>Atque rerum nesciunt</h4>-->
<!--                            <p>Quae dolorem earum veritatis oditseno</p>-->
<!--                            <p>1 hr. ago</p>-->
<!--                        </div>-->
<!--                    </li>-->
<!---->
<!--                    <li>-->
<!--                        <hr class="dropdown-divider">-->
<!--                    </li>-->
<!---->
<!--                    <li class="notification-item">-->
<!--                        <i class="bi bi-check-circle text-success"></i>-->
<!--                        <div>-->
<!--                            <h4>Sit rerum fuga</h4>-->
<!--                            <p>Quae dolorem earum veritatis oditseno</p>-->
<!--                            <p>2 hrs. ago</p>-->
<!--                        </div>-->
<!--                    </li>-->
<!---->
<!--                    <li>-->
<!--                        <hr class="dropdown-divider">-->
<!--                    </li>-->
<!---->
<!--                    <li class="notification-item">-->
<!--                        <i class="bi bi-info-circle text-primary"></i>-->
<!--                        <div>-->
<!--                            <h4>Dicta reprehenderit</h4>-->
<!--                            <p>Quae dolorem earum veritatis oditseno</p>-->
<!--                            <p>4 hrs. ago</p>-->
<!--                        </div>-->
<!--                    </li>-->
<!---->
<!--                    <li>-->
<!--                        <hr class="dropdown-divider">-->
<!--                    </li>-->

                    <li class="dropdown-footer">
                        <a href="/notification">Показать все уведомления</a>
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-success badge-number">3</span>
                </a><!-- End Messages Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header">
                        У вас 3 новых сообщения
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Посмотреть все</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="<?=SITE_URL?>templates/default/assets/img/messages-1.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Maria Hudson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="<?=SITE_URL?>templates/default/assets/img/messages-2.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Anna Nelson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>6 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="<?=SITE_URL?>templates/default/assets/img/messages-3.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>David Muldon</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>8 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="dropdown-footer">
                        <a href="#">Показать все сообщения</a>
                    </li>

                </ul><!-- End Messages Dropdown Items -->

            </li><!-- End Messages Nav -->



            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="<?=SITE_URL . USER_PROFILE_IMG . $_SESSION['profile_img']?>" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?=$_SESSION['name']?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?=$_SESSION['name']?></h6>
                        <?php foreach ($_SESSION['role'] as $value): ?>
                            <span><?=$value['role_title']?></span>
                            <br>
                        <?php endforeach; ?>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/profile">
                            <i class="bi bi-person"></i>
                            <span>Мой профиль</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.php" onclick="return false">
                            <i class="bi bi-gear"></i>
                            <span>Настройки аккаунта</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html" onclick="return false">
                            <i class="bi bi-question-circle"></i>
                            <span>Нужна помощь?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/login">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Выход</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->



