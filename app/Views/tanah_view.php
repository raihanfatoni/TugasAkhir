<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="wNoth=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <title>Data Tanah Wakaf</title>
</head>
<style>
    * {margin:-6px; padding:0;}
    body{
        background-image: url('https://telegra.ph/file/00447a4f3112c485abaa8.jpg');
    }

    nav {
     margin:auto;
     text-align: center;
     width: 120%;
    } 

    nav ul ul {
     display: none;
    }

    nav ul li:hover > ul{
    display: block;
    width: 150px;
    }

    nav ul {
     background: white;
     padding: 0 20px;
     list-style: none;
     position: relative;
     display: inline-table;
     width: 100%;
    }

    nav ul:after {
     content: ""; 
     clear:both; 
     display: block;
    }

    nav ul li{
     float:left;
    }

    nav ul li:hover{
     background:#666;
    }

    nav ul li:hover a{
     color:black;
    }


    nav ul ul{
     background: #53bd84;
     border-radius: 0px;
     padding: 0;
     position: absolute;
     top:100%;
    }

    nav ul ul li{
     float:none;
     border-top: 1px soild #53bd84;
     border-bottom: 1px solid #53bd84;
     position: relative;
    }

    th{
        border:2px solid black;
    }





    nav ul ul ul{
     position: absolute;
     left: 100%;
     top: 0;
    }
		tr, td{ 
  		border: 2px solid black;
		padding: 8px;
		color : black;
        text-align:center;

	}
        table {
            margin: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
        }
        input, textarea, {
         background: none;
         text-align: center;
         border: 2px solid #3498db;
         padding: 16px 20px;
         outline: none;
         color: black;
         border-radius: 24px;
        }
        .new{
            background-color: #3498db;
            color: white;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .navbar{
            margin:auto;
            text-align: center;
            width: 100%;
            padding-left:30px
        }
        .search{
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

    </style>
<body>
    
    <div class="navbar">
        <?php echo form_open('Tanah/Search') ?>
        <div class = "row">
                <div class="col-sm-8">
                    <input type="text" name="keyword" class="search" placeholder="Search">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success">Search</button>
                </div>
        </div>
        <?php echo form_close() ?>
    </div>
    <center><table>
        <thead>

            <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Kondisi Dahulu</th>
                <th>Luas Dahulu</th>
                <th>Luas Sekarang</th>
                <th>Luas (Bau)</th>
                <th>Luas (Tumbak)</th>
                <th>Luas (Meter)</th>
                <th>Status Kondisi Tanah</th>
                <th>Nadzir Wakaf</th>
                <th>Polygon</th>
                <th>Marker</th>
                <th> ID Kecamatan </th>
                <th>Link Google Earth</th>
                <th>Action</th>
                <th>Advanced</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tanah as $row) : ?>
                <tr>
                    <td><?= $row['No']; ?></td>
                    <td><?= $row['Lokasi']; ?></td>
                    <td><?= $row['Tipe']; ?></td>
                    <td><?= $row['LuasDahulu']; ?></td>
                    <td><?= $row['LuasSekarang']; ?></td>
                    <td><?= $row['LuasDalamBau']; ?></td>
                    <td><?= $row['LuasDalamTumbak']; ?></td>
                    <td><?= $row['LuasDalamMeterPersegi']; ?></td>
                    <td><?= $row['KoordinatLokasi']; ?></td>
                    <td><?= $row['NadzirWakaf']; ?></td>
                    <td><?= $row['polygon']; ?></td>
                    <td><?= $row['marker']; ?></td>
                    <td><?= $row['id_kecamatan']; ?></td>
                    <td><?= $row['googleearth']; ?></td>
                    <td>
                        <a href=<?= base_url("tanah/edit/{$row['No']}"); ?> class ="new">
                            Edit Manual
                        </a>
                        <a href=<?= base_url("tanah/delete/{$row['No']}"); ?> class ="new">
                            Delete Data
                        </a>
                    </td>
                    <td>
                        <a href=<?= base_url("Tanah/formmarkeredit/{$row['No']}")?> class ="new">
                            Edit Marker
                        </a>
                        <a href=<?= base_url("Tanah/formpolygonedit/{$row['No']}")?> class ="new">
                            Edit Polygon
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <a href=<?= base_url("tanah/add_new"); ?> class="new">
        Entry Data </a><br><br>
    </a>
    <a href=<?= base_url("homepage"); ?> class="new">
        Menu Admin </a><br><br>
    </a>
    <a href=logout class="new">
        Logout </a><br><br>
    </a>
    <a href=<?= base_url("home/Maps"); ?> class="new">
        Maps </a><br><br>
    </a>
    <a href=<?= base_url("kecamatan/index"); ?>  class="new">
        Kecamatan </a><br><br>
    </a>
    <a href=<?= base_url("nadzir/index"); ?>  class="new">
        Nadzir </a><br><br>
    </a>
</body>


</html>