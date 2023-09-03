<?php

require_once 'include/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/aside.php';


?>





    <main id="main" class="main">

    <div class="pagetitle">
      <h1>Профиль</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Главная</a></li>
          <li class="breadcrumb-item">Пользователи</li>
          <li class="breadcrumb-item active">Профиль</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?=SITE_URL . USER_PROFILE_IMG . $_SESSION['profile_img']?>" alt="Profile" class="rounded-circle">
              <h2><?=$this->userData['name']?></h2>
              <br>
                <?php foreach ($_SESSION['role'] as $value): ?>
                    <span><?=$value['role_title']?></span>
                <?php endforeach; ?>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link <?php if(!isset($_GET['error_type'])) echo 'active'?>" data-bs-toggle="tab" data-bs-target="#profile-overview">Обзор</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link <?php if(isset($_GET['error_type']) and $_GET['error_type'] == 1) echo 'active'?>" data-bs-toggle="tab" data-bs-target="#profile-edit">Редактировать профиль</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link <?php if(isset($_GET['error_type']) and $_GET['error_type'] == 2) echo 'active'?>" data-bs-toggle="tab" data-bs-target="#profile-settings">Настройки</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link <?php if(isset($_GET['error_type']) and $_GET['error_type'] == 3) echo 'active'?>" data-bs-toggle="tab" data-bs-target="#profile-change-password">Смена пароля/логина</button>
                </li>

              </ul>


              <div class="tab-content pt-2">




                <div class="tab-pane fade profile-overview <?php if(!isset($_GET['error_type'])) echo 'show active'?>" id="profile-overview">
                  <h5 class="card-title">Информация</h5>
                  <p class="small fst-italic"><?=$this->userData['info']?></p>

                  <h5 class="card-title">Данные</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">ФИО</div>
                    <div class="col-lg-9 col-md-8"><?=$this->userData['name']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Компания</div>
                    <div class="col-lg-9 col-md-8"><?=$this->userData['sub_title']?>, <?=$this->userData['sub_address']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Должность</div>
                    <div class="col-lg-9 col-md-8"><?=$this->userData['position']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Роли</div>
                      <div class="col-lg-9 col-md-8">
                          <?php foreach ($_SESSION['role'] as $value): ?>
                              <div><?=$value['role_title']?></div>
                          <?php endforeach; ?>
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Адрес</div>
                    <div class="col-lg-9 col-md-8"><?=$this->userData['address']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Телефон</div>
                    <div class="col-lg-9 col-md-8"><?=$this->userData['phone']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Почта</div>
                    <div class="col-lg-9 col-md-8"><?=$this->userData['email']?></div>
                  </div>

                </div>





                <div class="tab-pane fade profile-edit pt-3 <?php if(isset($_GET['error_type']) and $_GET['error_type'] == 1) echo 'show active'?>" id="profile-edit">
                  <!-- Profile Edit Form -->

                    <form method="post" enctype="multipart/form-data" action="/profile/update">

                        <div class="row mb-3">
                          <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Фотография профиля</label>
                          <div class="col-md-8 col-lg-9">
                            <img src="<?=SITE_URL . USER_PROFILE_IMG . $_SESSION['profile_img']?>" alt="Profile" id="uplode_img">
                            <div class="pt-2">
                                <div class="input-file-row">
                                    <label class="input-file">
                                        <input type="file" name="profile_file" accept="image/*" onchange="loadFile(event)">
                                        <span>Выберите файл</span>
                                    </label>
                                    <div class="input-file-list"></div>
                                </div>
                              <a href="profile/delete/img" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                            </div>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="fullName" class="col-md-4 col-lg-3 col-form-label">ФИО</label>
                          <div class="col-md-8 col-lg-9">
                              <?php
                                  if(isset($_GET['fullName']))
                                      $name = $_GET['fullName'];
                                  else
                                      $name = $this->userData['name'];
                              ?>
                            <input name="fullName" type="text" class="form-control" id="fullName" value="<?=$name?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="about" class="col-md-4 col-lg-3 col-form-label">Информация</label>
                          <div class="col-md-8 col-lg-9">
                              <?php
                              if(isset($_GET['about']))
                                  $info = $_GET['about'];
                              else
                                  $info = $this->userData['info'];
                              ?>
                            <textarea name="about" class="form-control" id="about" style="height: 100px"><?=$info?></textarea>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="Address" class="col-md-4 col-lg-3 col-form-label">Адрес</label>
                          <div class="col-md-8 col-lg-9">
                              <?php
                              if(isset($_GET['address']))
                                  $address = $_GET['address'];
                              else
                                  $address = $this->userData['address'];
                              ?>
                            <input name="address" type="text" class="form-control" id="Address" value="<?=$address?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Телефон</label>
                          <div class="col-md-8 col-lg-9">
                              <?php
                              if(isset($_GET['phone']))
                                  $phone = $_GET['phone'];
                              else
                                  $phone = $this->userData['phone'];
                              ?>
                            <input name="phone" type="text" class="form-control" id="Phone" value="<?=$phone?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="Email" class="col-md-4 col-lg-3 col-form-label">Почта</label>
                          <div class="col-md-8 col-lg-9">
                              <?php
                              if(isset($_GET['email']))
                                  $email = $_GET['email'];
                              else
                                  $email = $this->userData['email'];
                              ?>
                            <input name="email" type="email" class="form-control" id="Email" value="<?=$email?>">
                          </div>
                        </div>

                        <?php if(isset($_GET['error'])): ?>
                        <div class="row mb-3" style="color: red">
                            Ошибки:
                            <?=$_GET['error']?>
                        </div>
                        <?php endif; ?>

                        <div class="text-center">
                          <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>

                    </form><!-- End Profile Edit Form -->

                </div>




                <div class="tab-pane fade pt-3 <?php if(isset($_GET['error_type']) and $_GET['error_type'] == 2) echo 'show active'?>" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Уведомление по электронной почте</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                              Изменения, внесенные в вашу учетную запись
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                              Информация о новых продуктах и услугах
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                              Маркетинговые и промо-предложения
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                              Предупреждения о безопасности
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>




                <div class="tab-pane fade pt-3 <?php if(isset($_GET['error_type']) and $_GET['error_type'] == 3) echo 'show active'?>" id="profile-change-password">

                    <?php if(isset($_GET['error'])): ?>
                        <div class="row mb-3" style="color: red">
                            Ошибки:
                            <?=$_GET['error']?>
                        </div>
                    <?php endif; ?>

                    <div>
                        <h1>Логин</h1>
                        <!-- Change Password Form -->
                        <form action="/profile/login" method="post">
                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Старый логин</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="login" type="login" class="form-control" id="oldLogin">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Пароль</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password" type="password" class="form-control" id="currentPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Новый логин</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="newlogin" type="login" class="form-control" id="newLogin">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Повтор логина</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="renewlogin" type="login" class="form-control" id="renewLogin">
                                </div>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="login_btn">Изменить логин</button>
                            </div>
                        </form><!-- End Change Password Form -->
                    </div>

                    <br>

                    <div>
                        <h1>Пароль</h1>
                        <!-- Change Password Form -->
                        <form action="/profile/password" method="post">
                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Старый пароль</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password" type="password" class="form-control" id="currentPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Новый пароль</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Подтверждение пароля</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="password_btn">Изменить пароль</button>
                            </div>
                        </form><!-- End Change Password Form -->
                    </div>

                </div>




              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->




<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/footer.php';
?>
