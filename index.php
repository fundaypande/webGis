<!DOCTYPE html>
<html>
<head> <!-- untuk meta description, keywords, dan author bisa gantu dan di sesuaikan tapi yang meta charset sama viewport jangan di ganti -->

  <link rel="stylesheet" href="leaflet/lf/leaflet.css" /> <!-- memanggil css di folder leaflet -->
  <script src="leaflet/lf/leaflet.js"></script> <!-- memanggil leaflet.js di folder leaflet -->
  <script src="js/jquery-3.2.1.min.js"></script> <!-- memanggil jquery di folder js -->
  <script src="leaflet/lfprof/leaflet-providers.js"></script> <!-- memanggil leaflet-providers.js di folder leaflet provider -->
  <link rel="stylesheet" href="css/style.css" /> <!-- memanggil css style -->

  <!-- memanggil plugin group layers -->
  <link rel="stylesheet" href="leaflet/groupLayers/src/leaflet.groupedlayercontrol.css"/>
  <script src="leaflet/groupLayers/src/leaflet.groupedlayercontrol.js"></script>

  <!--memanggil plugin pencarian, Json dan Extend all-->
  <link rel="stylesheet" href="leaflet/leaflet-search-master/src/leaflet-search.css"/>
  <link rel="stylesheet" href="leaflet/leaflet.defaultextent-master/dist/leaflet.defaultextent.css" />
  <script src="leaflet/leaflet-ajax/dist/leaflet.ajax.js"></script>
  <script src="leaflet/leaflet-search-master/src/leaflet-search.js"></script>
  <script src="leaflet/leaflet.defaultextent-master/dist/leaflet.defaultextent.js"></script>

<!-- memanggil awesome marker -->
   <link rel="stylesheet" href="leaflet/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="leaflet/awesome-marker/dist/leaflet.awesome-markers.css">
   <script src="leaflet/awesome-marker/dist/leaflet.awesome-markers.js"></script>

  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name='description' content='WebGIS info-geospasial.com menyajikan berbagai konten spasial ke dalam bentuk Website'/>
  <meta name='keywords' content='WebGIS, WebGIS info-geospasial, WebGIS Indoensia'/>
  <meta name='Author' content='Egi Septiana'/>
  <title>WebGIS Jogjgakarta - PTI Untuksha</title> <!-- title bisa di sesuaikan dengan nama judul WebGIS yang di inginkan -->
</head>
<body>
<!-- bagian ini akan di isi konten utama -->

  <div id="map"> <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
  <script>

  var layer_permanent = $.getJSON("select.php", function (data) {
          for (var i = 0; i < data.length; i++) {
            var location = new L.LatLng(data[i].lat, data[i].long);
            var name = data[i].judul;
            var marker = new L.Marker(location).addTo(map)
            .bindPopup("<div style='text-align: center; margin-left: auto; margin-right: auto;'>"+ name +" <br /> <a href='delete.php?id="+ data[i].long +"'>Delete Marker</a>  </div>", {maxWidth: '400'});
          }
        });


  // MENGATUR TITIK KOORDINAT TITIK TENGAN & LEVEL ZOOM PADA BASEMAP
  var map = L.map('map').setView([-7.797068,110.370529], 4);

  // MENAMPILKAN SKALA
  L.control.scale({imperial: false}).addTo(map);

  // ------------------- VECTOR ----------------------------
  var layer_landuse = new L.GeoJSON.AJAX("layer/request_landuse.php",{ // sekarang perintahnya diawali dengan variabel
    style: function(feature){
    var fillColor, // ini style yang akan digunakan
            kode = feature.properties.id; // perwarnaan objek polygon berdasarkan kode kabupaten di dalam file geojson
             if ( kode = 1 ) fillColor = "#D8AD00";
        // no data
        return { color: "#990900", dashArray: '2', weight: 1, fillColor: fillColor, fillOpacity: 1 }; // style border sertaa transparansi
      },
      onEachFeature: function(feature, layer){
      //layer.bindPopup("<center>" + feature.properties.nama + "</center>"), // popup yang akan ditampilkan diambil dari filed kab_kot
      that = this; // perintah agar menghasilkan efek hover pada objek layer
            layer.on('mouseover', function (e) {
                this.setStyle({
                weight: 2,
                color: '#72152b',
                dashArray: '',
                fillOpacity: 0.8
                });
            layer.on('click', function(e){
              layer.bindPopup("<center>" + feature.properties.id + "</center> <a href='upload.php?lang=" + e.latlng.lat + "&long=" + e.latlng.lng +"'>Tambah Marker</a> (" + e.latlng.lat + ", " + e.latlng.lng +")");
              //alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng);
            });


            });
            layer.on('mouseout', function (e) {
                layer_landuse.resetStyle(e.target); // isi dengan nama variabel dari layer
                //info.update();
            });
    }
    }).addTo(map);

    var layer_point = new L.GeoJSON.AJAX("layer/request_point.php",{ // sekarang perintahnya diawali dengan variabel
      style: function(feature){
      var fillColor, // ini style yang akan digunakan
              kode = feature.properties.id; // perwarnaan objek polygon berdasarkan kode kabupaten di dalam file geojson
               if ( kode > 1 ) fillColor = "#ffd700";
          // no data
          return { color: "#999", dashArray: '3', weight: 2, fillColor: fillColor, fillOpacity: 1 }; // style border sertaa transparansi
        },
        onEachFeature: function(feature, layer){
        layer.bindPopup("<center>" + feature.properties.nama + "</center> <div> <img src='"+ feature.properties.url +"' /> </div>" + layer.getLatLng() +" " +feature.properties.url), // popup yang akan ditampilkan diambil dari filed kab_kot
        that = this; // perintah agar menghasilkan efek hover pada objek layer
              layer.on('mouseover', function (e) {
                  this.setStyle({
                  weight: 2,
                  color: '#72152b',
                  dashArray: '',
                  fillOpacity: 0.8
                  });


              });
              layer.on('mouseout', function (e) {
                  layer_point.resetStyle(e.target); // isi dengan nama variabel dari layer
                  //info.update();
              });
      }
      }).addTo(map);

    var marker1 = L.AwesomeMarkers.icon({
      icon: 'user-circle',
      prefix: 'fa',
      iconColor: 'white',
      markerColor: 'red'
     });

    var layer_wisata = new L.GeoJSON.AJAX("layer/request_wisata.php",{ // sekarang perintahnya diawali dengan variabel
      style: function(feature){
      var fillColor, // ini style yang akan digunakan
              kode = feature.properties.id; // perwarnaan objek polygon berdasarkan kode kabupaten di dalam file geojson
               if ( kode > 1 ) fillColor = "#ffd700";
          // no data
          return { color: "#999", dashArray: '3', weight: 2, fillColor: fillColor, fillOpacity: 1 }; // style border sertaa transparansi
        },
        onEachFeature: function(feature, layer){
        layer.bindPopup("<center>" + feature.properties.nama + " <div> <img src='"+ feature.properties.url +"' height='150px' /> <br /> <a href='https://www.google.co.id/search?q="+ feature.properties.nama +"' target='_blank'>Cari Informasi Lebih Lanjut</a> </div> </center>" + layer.getLatLng()), // popup yang akan ditampilkan diambil dari filed kab_kot
        that = this; // perintah agar menghasilkan efek hover pada objek layer
              layer.on('mouseover', function (e) {
                  this.setStyle({
                  weight: 2,
                  color: '#72152b',
                  dashArray: '',
                  fillOpacity: 0.8
                  });
              });
              layer.on('mouseout', function (e) {
                  layer_wisata.resetStyle(e.target); // isi dengan nama variabel dari layer
                  //info.update();
              });
      }, //costum icon
      pointToLayer: function (feature, latlng) {
              return L.marker(latlng, {icon: marker1});
      }
      }).addTo(map);

  //make label
  var marker = new L.marker([59.5343180010956, 96.85546875000001], { opacity: 0 }); //opacity may be set to zero
  marker.bindTooltip("New My Label", {permanent: true, className: "my-label", offset: [0, 0] });
  marker.addTo(map);
  // PILIHAN BASEMAP YANG AKAN DITAMPILKAN
  var baseLayers = {
  //'Esri.WorldTopoMap': L.tileLayer.provider('Esri.WorldTopoMap').addTo(map),
  //'Esri WorldImagery': L.tileLayer.provider('Esri.WorldImagery')
  };


  // MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
  //L.control.layers(baseLayers,{}).addTo(map);
  // membuat pilihan untuk menampilkan layer
  var overlays = {
        "KOTA JOGYAKARTA": {
          "Point": layer_point,
          "Objek WIsata" : layer_wisata,
          "Layer Permanen" : layer_permanent,
          "Landuse 2": layer_landuse
        }
        };
  var options = {
    exclusiveGroups: ["PROVINSI BALI"]
  };
  // MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
  L.control.groupedLayers(baseLayers, overlays, options).addTo(map);
  </script>
  </div>


</body>
</html>
<?php
require_once 'connect.php';


require_once 'index.php';

$result = pg_query($dbconn, "SELECT * FROM permanent_marker");
if (!$result) {
    echo "An error occurred.\n";
    exit;
}

$arr = pg_fetch_all($result);

echo $arr[0][judul];

echo "<pre>";
print_r($arr);
echo "</pre>";

 ?>
