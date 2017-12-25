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

  // MENAMPILKAN SKALA
  L.control.scale({imperial: false}).addTo(map);

  // ------------------- VECTOR ----------------------------

  var layer_jogja = new L.GeoJSON.AJAX("layer/request_jogja.php",{ // sekarang perintahnya diawali dengan variabel
    style: function(feature){
    var fillColor, // ini style yang akan digunakan
            kode = feature.properties.id; // perwarnaan objek polygon berdasarkan kode kabupaten di dalam file geojson
             if ( kode > 4 ) fillColor = "#ffd700";
        // no data
        return { color: "#999", dashArray: '3', weight: 2, fillColor: fillColor, fillOpacity: 1 }; // style border sertaa transparansi
      },
      onEachFeature: function(feature, layer){
      layer.bindPopup("<center>" + feature.properties.nama + "</center>"), // popup yang akan ditampilkan diambil dari filed kab_kot
      that = this; // perintah agar menghasilkan efek hover pada objek layer
            layer.on('mouseover', function (e) {
                this.setStyle({
                weight: 2,
                color: '#72152b',
                dashArray: '',
                fillOpacity: 0.8
                });

            if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
            }

                info.update(layer.feature.properties);
            });
            layer.on('mouseout', function (e) {
                layer_ADMINISTRASI.resetStyle(e.target); // isi dengan nama variabel dari layer
                info.update();
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
        layer.bindPopup("<center>" + feature.properties.nama + "</center>"), // popup yang akan ditampilkan diambil dari filed kab_kot
        that = this; // perintah agar menghasilkan efek hover pada objek layer
              layer.on('mouseover', function (e) {
                  this.setStyle({
                  weight: 2,
                  color: '#72152b',
                  dashArray: '',
                  fillOpacity: 0.8
                  });

              if (!L.Browser.ie && !L.Browser.opera) {
                  layer.bringToFront();
              }

                  info.update(layer.feature.properties);
              });
              layer.on('mouseout', function (e) {
                  layer_ADMINISTRASI.resetStyle(e.target); // isi dengan nama variabel dari layer
                  info.update();
              });
      }
      }).addTo(map);

  var greenIcon = L.icon({
        iconUrl: 'img/hospital.png',
        shadowUrl: 'leaflet/lf/images/marker-shadow.png',

        iconSize:     [20, 60], // size of the icon
        shadowSize:   [15, 40], // size of the shadow
        iconAnchor:   [15, 60], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });
    
  var layer_sakit = new L.GeoJSON.AJAX("layer/request_rumah_sakit.php",{ // sekarang perintahnya diawali dengan variabel
    style: function(feature){
    var fillColor, // ini style yang akan digunakan
            kode = feature.properties.id; // perwarnaan objek polygon berdasarkan kode kabupaten di dalam file geojson
             if ( kode > 1 ) fillColor = "#ffd700";
        // no data
        return { color: "#999", dashArray: '3', weight: 2, fillColor: fillColor, fillOpacity: 1 }; // style border sertaa transparansi
      },
      onEachFeature: function(feature, layer){
      layer.bindPopup("<center>" + feature.properties.nama + "</center>"), // popup yang akan ditampilkan diambil dari filed kab_kot
      that = this; // perintah agar menghasilkan efek hover pada objek layer
            layer.on('mouseover', function (e) {
                this.setStyle({
                weight: 2,
                color: '#72152b',
                dashArray: '',
                fillOpacity: 0.8
                });

            if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
            }
                info.update(layer.feature.properties);
            });
            layer.on('mouseout', function (e) {
                layer_ADMINISTRASI.resetStyle(e.target); // isi dengan nama variabel dari layer
                info.update();
            });
    }, //costum icon
    pointToLayer: function (feature, latlng) {
            return L.marker(latlng, {icon: greenIcon});
        }
    }).addTo(map);

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
          "Rumah Sakit": layer_sakit,
          "Point": layer_point,
          "Lannduse": layer_jogja
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
