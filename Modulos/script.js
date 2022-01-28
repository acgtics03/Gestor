function iniciarMap(){
    var coord = {lat:-12.5545583 ,lng: -75.4123449};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 4,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });
}