<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Data</title>
</head>
<style>
    body{
        background-image: url('https://telegra.ph/file/00447a4f3112c485abaa8.jpg');
    }
	a:link, a:visited {
        margin : 20px auto;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

	label,h3{
		color: white;
        font-size: 20px;
	}
    .box{
		width: 400px;
  		padding: 10px;
  		border: 5px solid white;
  		margin-top: 100px;
		background: transparent;
	}
	input{
         background: white;
         text-align: center;
         border: 2px solid #3498db;
         padding: 16px 20px;
         outline: none;
         color: black;
         border-radius: 10px;
         margin: 30px;
        }
        a,button{
            background-color: #3498db;
  color: white;
  padding: 15px;
  text-align: center;
  text-decoration: none;
        }
    </style>
<center>
<body>
    <form action=<?= base_url("/tanah/save") ?> method="post">
    <div class="box">
        <h3>Form Entry Data Tanah</h3>
        <div><label>Nomor Tanah : </label><input type="text" name="No" class="form-control"></div>
        <div><label>Lokasi dan Batas</label><input type="text" name="Lokasi" class="form-control"></div>
        <div><label>Kondisi Dahulu</label><input type="text" name="Tipe" class="form-control"></div>
        <div><label>Luas Dahulu : </label><input type="text" name="LuasDahulu" class="form-control"></div>
        <div><label>Luas Sekarang: </label><input type="text" name="LuasSekarang" class="form-control"></div>
        <div><label>Luas Dalam Bau: </label><input type="text" name="LuasDalamBau" class="form-control"></div>
        <div><label>Luas Dalam Tumbak: </label><input type="text" name="LuasDalamTumbak" class="form-control"></div>
        <div><label>Luas Dalam Meter Persegi: </label><input type="text" name="LuasDalamMeterPersegi" class="form-control"></div>
        <div><label>Nadzir Wakaf: </label><input type="text" name="NadzirWakaf" class="form-control"></div>
        <div><label>Status Kondisi Tanah: </label><input type="text" name="KoordinatLokasi" class="form-control"></div>
        <div><label>ID Kecamatan: </label><input type="text" name="id_kecamatan" class="form-control"></div>
        <div><label>Link Google Earth:</label><input type="text" name="googleearth" class="form-control"></div>
        <div><label>Titik Marker: </label><input type="text" name="marker" class="form-control"></div>
        <button type="submit">Save</button>
        </div>
    </form>
</body>
</center>

</html>
