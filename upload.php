<?php
  $long = $_GET['long'];
  $lang = $_GET['lang'];
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Tambah Marker</title>
  </head>
  <body>
    <form method="post" action="insert.php">
        <div class="form-group">
            <label for="masukkanLong">Longitude </label>
            <input type="text" name="long" class="form-control" id="masukkanNama" placeholder="Masukkan Longitude" value="<?php echo $long ?> "/>
        </div>
        <div class="form-group">
            <label for="masukkanLat">Latitude</label>
            <input type="text" name="lang" class="form-control" id="masukkanEmail" placeholder="Masukkan Latitude" value="<?php echo $lang ?> "/>
        </div>
        <div class="form-group">
            <label for="masukkanEmail">Latitude</label>
            <input type="text" name="judul" class="form-control" id="masukkanEmail" placeholder="Masukkan Judul"/>
        </div>
        <button type="submit" value="simpan">SIMPAN</button>
    </form>
  </body>
</html>
