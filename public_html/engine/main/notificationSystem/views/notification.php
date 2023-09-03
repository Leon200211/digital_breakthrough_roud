<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/aside.php';
?>



    <main id="main" class="main">

        <div class="pagetitle">

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item"><a href="/notification">Уведомления</a></li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Уведомления</h6>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Дата</th>
                        <th scope="col">Описание</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($notice as $key => $n): ?>
                    <tr>
                        <th scope="row"><a href="#"> <img src="<?=SITE_URL . '/files/notice/icon/' . $n['img']?>" width="40px;" style="margin-right: 10px;"></a></th>
                        <td><a href="<?=$n['path']?>" class="text-primary fw-bold" onclick="readNotification(<?=$n['id']?>, <?=$n['id_user']?>)"><?=$n['title']?></a></td>
                        <td class="fw-bold"><?=$n['date']?></td>
                        <td><?=$n['note']?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
        </div>









    </main>




<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/footer.php';
?>