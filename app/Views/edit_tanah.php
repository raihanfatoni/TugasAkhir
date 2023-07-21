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
<center><body>
    <form action=<?= base_url("/tanah/update") ?> method="post">
    <div class="box">
        <h3>Form Entry Data Tanah</h3>
        <input type="hidden" name="No" value="<?= $tanah->No; ?>">
        <div><label>Lokasi dan Batas</label><input type="text" value= <?= $tanah->Lokasi?>  name="Lokasi" class="form-control"></div>
        <div><label>Kondisi Tanah Dahulu</label><input type="text" value= <?= $tanah->Lokasi?>  name="Tipe" class="form-control"></div>
        <div><label>Luas Tanah Dahulu : </label><input type="text" value= <?= $tanah->LuasDahulu?>  name="LuasDahulu" class="form-control"></div>
        <div><label>Luas Tanah Sekarang: </label><input type="text" value= <?= $tanah->LuasSekarang?>  name="LuasSekarang" class="form-control"></div>
        <div><label>Luas Dalam Bau: </label><input type="text" value= <?= $tanah->LuasDalamBau?>  name="LuasDalamBau" class="form-control"></div>
        <div><label>Luas Dalam Tumbak: </label><input type="text" value= <?= $tanah->LuasDalamTumbak?>  name="LuasDalamTumbak" class="form-control"></div>
        <div><label>Luas Dalam Meter Persegi: </label><input type="text" value= <?= $tanah->LuasDalamMeterPersegi?>  name="LuasDalamMeterPersegi" class="form-control"></div>
        <div><label>Status Tanah: </label><input type="text" value= <?= $tanah->KoordinatLokasi?>  name="KoordinatLokasi" class="form-control"></div>
        <div><label>Nadzir Wakaf Tanah: </label><input type="text" value= <?= $tanah->NadzirWakaf?>  name="NadzirWakaf" class="form-control"></div>
        <div><label>ID Kecamatan: </label><input type="text" value= <?= $tanah->id_kecamatan?>  name="id_kecamatan" class="form-control"></div>
        <div><label>Titik Marker:</label><input type="text" placeholder= <?= $tanah->marker?>  name="marker" class="form-control"></div>
        <div><label>Link Google Earth:</label><input type="text" value= <?= $tanah->googleearth?>  name="googleearth" class="form-control"></div>
        <input type="hidden" name="id" value="<?= $tanah->No; ?>">
        <button type="submit">Update</button>
        </div>
    </form>
</body></center>

</html>
