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


        <select id='date_filter'>
            <?php 
            foreach($this->dates as $date) {
                echo "<option value='{$date['date']}'>{$date['date']}</option>";
            }
            ?>
        </select>
        <div class="filters">
            <div class="filter">
                <label for="Выбоина"><input type="checkbox" id="type_1" checked class="checkbox" rel="яма">Выбоина</label>
            </div>
            <div class="filter">
                <label for="Аллигаторная трещина"><input type="checkbox" id="type_2" checked class="checkbox" rel="скол">Аллигаторная трещина</label>
            </div>
            <div class="filter">
                <label for="Поперечная трещина"><input type="checkbox" id="type_3" checked class="checkbox" rel="скол">Поперечная трещина</label>
            </div>
            <div class="filter">
                <label for="Продольная трещина"><input type="checkbox" id="type_4" checked class="checkbox" rel="скол">Продольная трещина</label>
            </div>
        </div>
    </section>
</main>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<div id="map" style = "width:100vw; height:500px;"></div>



авпва
вапвап
вапвапва





<!--<div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Babakina%20Street,%20Khimki,%20Russia+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Population mapping</a></iframe></div>-->
<!-- <script src="/templates/default/index.js"></script> -->

<script>
const file_upload = document.getElementById('file-upload')
const filter1 = document.getElementById('type_1')
const filter2 = document.getElementById('type_2')

const filters = document.querySelectorAll('.checkbox')

const date_filter = document.getElementById('date_filter')

const map = L.map('map', {
    center: [55.75185, 37.61169],
    zoom: 8
});

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

let type_1_icon = L.icon({
    iconUrl: '/templates/default/icon.png',
    iconRetinaUrl: '/templates/default/icon.png',
    iconSize: [38, 38],
    iconAnchor: [30, 30],
    // popupAnchor: [-3, -76],
});
let type_2_icon = L.icon({
    iconUrl: '/templates/default/defaultMarker.png',
    iconRetinaUrl: '/templates/default/defaultMarker.png',
    iconSize: [26, 34],
    iconAnchor: [30, 30],
});

const markers = [
    <?php 
        foreach($this->markers as $key => $marker) {
            echo "{
                marker_id: $key,
                marker_coordsX: {$marker['marker_coords_x']},
                marker_coordsY: {$marker['marker_coords_y']},
                iconType: {$marker['type']}_icon,
                note: '{$marker['note']}',
                type: '{$marker['type']}',
                date: '{$marker['date']}',
            },";
        }    
    ?>
]



let markers_array = []
markers.forEach(item => {
    if(item.date == date_filter.value) {
        var marker = L.marker([item.marker_coordsX, item.marker_coordsY], {icon: item.iconType})
        //marker.bindPopup(item.note).openPopup()
        marker.bindPopup("<img width='20px'; height='20px'; src='/templates/default/defaultMarker.png'><br>" + item.note).openPopup()
        markers_array.push(marker)
    }
})
for (let i = 0; i < markers_array.length; i++) {
    map.addLayer(markers_array[i])
}

filters.forEach(box => {
    box.onchange = (event) => {
        // очистить всю карту нахуй
        for (let i = 0; i < markers_array.length; i++) {
            map.removeLayer(markers_array[i])
        }  
        markers_array = []
        filters.forEach(activ_box => {
            if(activ_box.checked) {
                // добавить точки определенного типа
                for (let i = 0; i < markers.length; i++) {
                    if(markers[i].type == activ_box.id && markers[i].date == date_filter.value) {
                        var marker = L.marker([markers[i].marker_coordsX, markers[i].marker_coordsY], {icon: markers[i].iconType})
                        marker.bindPopup(markers[i].note).openPopup()
                        map.addLayer(marker)
                        markers_array.push(marker)
                    }
                }   

            }
        })
    }
})


date_filter.onchange = (event) => {
    // очистить всю карту нахуй
    for (let i = 0; i < markers_array.length; i++) {
            map.removeLayer(markers_array[i])
        }  
        markers_array = []
        filters.forEach(activ_box => {
            if(activ_box.value) {
                // добавить точки определенного типа
                for (let i = 0; i < markers.length; i++) {
                    if(markers[i].type == activ_box.id && markers[i].date == date_filter.value) {
                        var marker = L.marker([markers[i].marker_coordsX, markers[i].marker_coordsY], {icon: markers[i].iconType})
                        marker.bindPopup(markers[i].note).openPopup()
                        map.addLayer(marker)
                        markers_array.push(marker)
                    }
                }   

            }
        })
}
</script>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>