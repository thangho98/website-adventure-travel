



///////////////////////////////////////////////
function Main() {
    new SearchForm().Init();
    new User().Init();
    new TourDetails().Init();
}

document.addEventListener('loadend', Main());

// Initialize and add the map

function initMap() {
    // Set location
    let uluru = { lat: -36.342, lng: 131.036 };

    var map = new google.maps.Map(
        document.getElementById('map'), { zoom: 4, center: uluru });
    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({ position: uluru, map: map });
}