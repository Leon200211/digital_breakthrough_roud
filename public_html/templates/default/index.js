const file_upload = document.getElementById('file-upload')
const filter1 = document.getElementById('type_1')
const filter2 = document.getElementById('type_2')

const filters = document.querySelectorAll('.checkbox')

const map = L.map('map', {
    center: [55.75185, 37.61169],
    zoom: 8
});

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

let myIcon = L.icon({
    iconUrl: '/templates/default/icon.png',
    iconRetinaUrl: '/templates/default/icon.png',
    iconSize: [38, 38],
    iconAnchor: [30, 30],
    // popupAnchor: [-3, -76],
});
let defaultIcon =
    L.icon({
        iconUrl: '/templates/default/defaultMarker.png',
        iconRetinaUrl: '/templates/default/defaultMarker.png',
        iconSize: [26, 34],
        iconAnchor: [30, 30],
    });

const markers = [
    {
        marker_id: 0,
        marker_coordsX: 55.88199,
        marker_coordsY: 37.42896,
        iconType: defaultIcon,
        type: 'type_1',
    },
    {
        marker_id: 1,
        marker_coordsX: 55.90512,
        marker_coordsY: 37.46367,
        iconType: myIcon,
        type: 'type_2',
    }
]






let markers_array = []
markers.forEach(item => {
    var marker = L.marker([item.marker_coordsX, item.marker_coordsY], {icon: item.iconType})
    marker.bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup()
    markers_array.push(marker)
})
for (let i = 0; i < markers_array.length; i++) {
    map.addLayer(markers_array[i])
}   

filters.forEach(box => {
    box.onchange = (event) => {

        // очистить всю карту нахуй

        filters.forEach(activ_box => {

            
            if(activ_box.checked) {
                console.log(activ_box.id)

                // добавить точки определенного типа
                var marker = L.marker([55.88199, 37.46367], {icon: myIcon})
                marker.bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup()
                console.log(map.addLayer(marker))

            }
                


        })

       
    }



    // //     console.log(item.marker_id)
    // //     console.log(markers_array[item.marker_id])
    // //     console.log(item)
    // //     if(!event.target.checked) {
    // //             if(box.id === item.type){
    // //                   markers_array.shift(item.marker_id)
    // //
    // //                 }
    // //             else {
    // //                 return;
    // //             }
    // //
    // //             }
    // }
    // })
})