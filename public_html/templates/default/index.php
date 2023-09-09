<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="/templates/default/index.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
</head>
<body>
<header>
    <div class="header-line">
        <div class="logo-bg">
            <span class="logo-text">дорожный</span>
            <span class="logo-text">контроль</span>
        </div>
    </div>
</header>
<main>
    <section class="container">
        <input type="file" id="file-upload" hidden onchange="">
        <label for="file-upload" class="upload-file">
            <div class="btn">
                <span class="noselect">
                    <ion-icon name="cloud-upload-outline"></ion-icon>
                    Загрузить
                </span>
            </div>
        </label>
        <div class="filters">
            <div class="filter">
                <label for="яма"><input type="checkbox" id="type_1" checked class="checkbox" rel="яма">Ямы</label>
            </div>
            <div class="filter">
                <label for="скол"><input type="checkbox" id="type_2" checked class="checkbox" rel="скол">Сколы</label>
            </div>
        </div>
    </section>
</main>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<div id="map" style = "width:100vw; height:100vh;"></div>
<!--<div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Babakina%20Street,%20Khimki,%20Russia+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Population mapping</a></iframe></div>-->
<script src="/templates/default/index.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>