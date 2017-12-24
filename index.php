<!DOCTYPE html>
<html>
<head> <!-- untuk meta description, keywords, dan author bisa gantu dan di sesuaikan tapi yang meta charset sama viewport jangan di ganti -->

  <link rel="stylesheet" href="leaflet/lf/leaflet.css" /> <!-- memanggil css di folder leaflet -->
  <script src="leaflet/lf/leaflet.js"></script> <!-- memanggil leaflet.js di folder leaflet -->
  <script src="js/jquery-3.2.1.min.js"></script> <!-- memanggil jquery di folder js -->
  <script src="leaflet/lfprof/leaflet-providers.js"></script> <!-- memanggil leaflet-providers.js di folder leaflet provider -->
  <link rel="stylesheet" href="css/style.css" /> <!-- memanggil css style -->

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
  // MENGATUR TITIK KOORDINAT TITIK TENGAN & LEVEL ZOOM PADA BASEMAP
  var map = L.map('map').setView([-7.797068,110.370529], 1);

  // PILIHAN BASEMAP YANG AKAN DITAMPILKAN
  var baseLayers = {
  //'Esri.WorldTopoMap': L.tileLayer.provider('Esri.WorldTopoMap').addTo(map),
  //'Esri WorldImagery': L.tileLayer.provider('Esri.WorldImagery')
  };

  // MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
  L.control.layers(baseLayers,{}).addTo(map);
  // MENAMPILKAN SKALA
  L.control.scale({imperial: false}).addTo(map);

  // ------------------- VECTOR ----------------------------
  // REQUEST BALI ADMINISTRASI
  $.ajax({ // ini perintah syntax ajax untuk memanggil vektor
    type: 'POST',
    url: 'layer/request_jogja.php', // INI memanggil link request_bali yang sebelumnya telah di buat
    dataType: "json",
  success: function(response){
   var data=response;
   L.geoJson(data,{
     style: function(feature){
    var Style1
    return { color: "#cc3f39", weight: 1, opacity: 1 }; // ini adalah style yang akan digunakan
    },
      // MENAMPILKAN POPUP DENGAN ISI BERDASARKAN ATRIBUT KAB_KOTA
      onEachFeature: function( feature, layer ){
        layer.bindPopup( "<center>" + feature.properties.nama + "</center>")
      }
      }).addTo(map);  // di akhir selalu di akhiri dengan perintah ini karena objek akan ditambahkan ke map
    }
  });

  // REQUEST Point Jogja
  $.ajax({ // ini perintah syntax ajax untuk memanggil vektor
    type: 'POST',
    url: 'layer/request_point.php', // INI memanggil link request_bali yang sebelumnya telah di buat
    dataType: "json",
  success: function(response){
   var data=response;
   L.geoJson(data,{
     style: function(feature){
    var Style1
    return { color: "#282C34", weight: 1, opacity: 1 }; // ini adalah style yang akan digunakan
    },
      // MENAMPILKAN POPUP DENGAN ISI BERDASARKAN ATRIBUT KAB_KOTA
      onEachFeature: function( feature, layer ){
        layer.bindPopup( "<center>" + feature.properties.nama + "</center>") //bisa isi gambar dengan meletakkan url di database dan memanggilnya disini
      }
      }).addTo(map);  // di akhir selalu di akhiri dengan perintah ini karena objek akan ditambahkan ke map
    }
  });
  </script>
  </div>
</body>
</html>
