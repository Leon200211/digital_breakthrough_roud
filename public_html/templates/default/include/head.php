<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?=$this->title?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?=SITE_URL?>templates/default/assets/img/favicon.png" rel="icon">
    <link href="<?=SITE_URL?>templates/default/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?=SITE_URL?>templates/default/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=SITE_URL?>templates/default/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=SITE_URL?>templates/default/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?=SITE_URL?>templates/default/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?=SITE_URL?>templates/default/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?=SITE_URL?>templates/default/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?=SITE_URL?>templates/default/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?=SITE_URL?>templates/default/assets/css/style.css" rel="stylesheet">
    <link href="<?=SITE_URL?>templates/default/assets/css/style_chat.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</head>

<body>
<script>
    window.onload = function () {
        document.body.classList.add('loaded');
    }
</script>
<style>
    .preloader {
        /*фиксированное позиционирование*/
        position: fixed;
        /* координаты положения */
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        /* фоновый цвет элемента */
        background: #e0e0e0;
        /* размещаем блок над всеми элементами на странице (это значение должно быть больше, чем у любого другого позиционированного элемента на странице) */
        z-index: 1001;
    }

    .preloader__row {
        position: relative;
        top: 50%;
        left: 50%;
        width: 70px;
        height: 70px;
        margin-top: -35px;
        margin-left: -35px;
        text-align: center;
        animation: preloader-rotate 2s infinite linear;
    }

    .preloader__item {
        position: absolute;
        display: inline-block;
        top: 0;
        background-color: #337ab7;
        border-radius: 100%;
        width: 35px;
        height: 35px;
        animation: preloader-bounce 2s infinite ease-in-out;
    }

    .preloader__item:last-child {
        top: auto;
        bottom: 0;
        animation-delay: -1s;
    }

    @keyframes preloader-rotate {
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes preloader-bounce {

        0%,
        100% {
            transform: scale(0);
        }

        50% {
            transform: scale(1);
        }
    }

    .loaded_hiding .preloader {
        transition: 0.3s opacity;
        opacity: 0;
    }

    .loaded .preloader {
        display: none;
    }
</style>
<div class="preloader">
    <div class="preloader__row">
        <div class="preloader__item"></div>
        <div class="preloader__item"></div>
    </div>
</div>
