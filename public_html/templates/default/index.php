
<?php

require_once 'include/head.php';
require_once 'include/header.php';
require_once 'include/aside.php';


?>




<main id="main" class="main">
    <br>
    <br>
    <h1>
        Добро пожаловать в систему, <?=$_SESSION['name']?>!
    </h1>
    <br>
    <br>

    <div class="card">
        <div class="card-body">
            <br>
            <h1>Напоминания:</h1>
            <div style="font-size: 30px;">
                <strong>22.01.2023 в 20:00</strong> начинается смена!
            </div>
        </div>
    </div>

</main><!-- End #main -->


<?php
require_once 'include/footer.php';
?>
