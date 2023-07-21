<?php
    $dropdownMenu = [
        'name'=> 'master',
        'options'=> $masterDataMenu,
        'class'=> 'form-control'
    ];

    $dropdownTipe = [
        'name'=> 'tipe',
        'options'=> $tipeTanah,
        'class'=> 'form-control'
    ];

    $dropdownTanah = [
        'name'=> 'tanah',
        'options'=> $namaTanah,
        'class'=> 'form-control'
    ];

    $dropdownKecamatan = [
        'name'=> 'kecamatan',
        'options'=> $namaKecamatan,
        'class'=> 'form-control'
    ];

    $submit = [
        'name'=>'submit',
        'id'=>'submit',
        'value'=>'Pilih Data',
        'class'=>'btn btn-primary',
        'type'=>'submit'
    ];
?>
<?= $this->extend('layout')?>

<?= $this->section('head')?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="http://localhost/tugasakhir/public/leaflet/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <link rel="stylesheet" href = "http://localhost/tugasakhir/public/leaflet/leaflet.css">
    <link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <style>
        #maps{
            height: 500px;
        }
        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255,255,255,0.8);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            line-height: 18px;
            color: #555;
        }
        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
        .textarea{
            width: 1610px;
            height: 200px;
        }

        .modal {
     display: none;
     position: fixed;
     left: 0;
     top: 0;
     width: 100%;
     height: 100%;
     overflow: auto;
     background-color: rgba(0, 0, 0, 0.4);
   }

   .modal-content {
     background-color: #fefefe;
     margin: 15% auto;
     padding: 20px;
     border: 1px solid #888;
     width: 80%;
   }

   .close {
     color: #aaa;
     float: right;
     font-size: 28px;
     font-weight: bold;
   }

   .close:hover,
   .close:focus {
     color: #000;
     text-decoration: none;
     cursor: pointer;
   }
    </style>
<?= $this->endSection()?>

<?= $this->section('content')?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="row">
    <div class="card">
        <div class="card-body">
            <?= form_open('Tanah/polygonsumedang') ?>
                <div class="row mt-3 mb-3">
                    <div class="col-md-10">
                        <b> Pilih Tipe Tanah Wakaf </b>
                        <?= form_dropdown($dropdownTipe) ?>
                    </div>
                    <div class="col-md-2 pt-3">
                        <?= form_submit($submit) ?>
                    </div>
                </div>
            <?= form_close() ?>
            <?= form_open('Tanah/polygonsumedang') ?>
                <div class="row mt-3 mb-3">
                    <div class="col-md-10">
                        <b> Pilih Nama Tanah Wakaf </b>
                        <?= form_dropdown($dropdownTanah) ?>
                    </div>
                    <div class="col-md-2 pt-3">
                        <?= form_submit($submit) ?>
                    </div>
                </div>
            <?= form_close() ?>
            <?= form_open('Tanah/polygonsumedang') ?>
                <div class="row mt-3 mb-3">
                    <div class="col-md-10">
                        <b> Pilih Kecamatan Tanah Wakaf </b>
                        <?= form_dropdown($dropdownKecamatan) ?>
                    </div>
                    <div class="col-md-2 pt-3 ">
                        <?= form_submit($submit) ?>
                    </div>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="maps"></div>
<br>
<textarea class="textarea" name="polygon"></textarea>
<?= $this->endSection()?>

<?= $this->section('script')?>
<script>

    var data = <?= json_encode($data) ?>;
    var data1 = <?= json_encode($data1) ?>; 
    var nilaiMax = <?= $nilaiMax ?>;

    function getColor(d) {
		return d > 18.10336118    ? '#66ff33' :
           d > 2.563305415    ? '#ffff00' :
                                    '#ff0000';
        console.log('jml',d);
    }

    function style(feature){
        return{
            weight : 1,
            opacity : 1,
            color : 'white',
            dashArray : '3',
            fillOpacity : 0.7,
            fillColor : getColor(parseInt(feature.properties.jumlahtanahwakaf))
        };
    }

    function onEachFeature(feature,layer)
    {
        layer.bindPopup("<h4>Jumlah Proyeksi Penduduk</h4> <br>"+feature.properties.Propinsi+": "+feature.properties.nilai+"000 Ribu Jiwa")
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
        });
    }

    var map = L.map('maps').setView({lat : -6.85861, lon : 107.91639}, 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    // L.marker({lat : -6.85861, lon : 107.91639}).bindPopup('This is Sumedang').addTo(map);
    // L.marker({lat : -6.9016812, lon : 107.8648377}).bindPopup('Blok Sawahlega').addTo(map);
    // L.marker({lat : -6.9094134, lon : 107.834653}).bindPopup('Margamekar').addTo(map);
    // L.marker({lat : -6.8755889, lon : 107.9063355}).bindPopup('Cipameungpeuk').addTo(map);
    // L.marker({lat : -6.8679511, lon : 107.9239302}).bindPopup('Sukagalih').addTo(map);
    
    var drawnItems = new L.FeatureGroup();
    var markertanah = <?= json_encode($marker) ?>;
    var latlng = []; 
    var marker = [];
    var properties = [];
    var daerah = [];
    var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
    for (let i = 0; i < markertanah.length; i++ ){
        latlng[i] = markertanah[i].geometry.coordinates;
        properties[i] = markertanah[i].properties;
        $('.modal-body').append(`
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="list-group">
                            <li class="list-group-item"><h3>${properties[i].Lokasi}</h3></li>
                            <li class="list-group-item"><h3>${properties[i].Lokasi}</h3></li>
                            <li class="list-group-item"><h3>${properties[i].Lokasi}</h3></li>
                            <li class="list-group-item"><h3>${properties[i].Lokasi}</h3></li>
                            </ul>
                        </div>
                    </div>
                </div>
            `);
        
        
        marker = new L.marker([latlng[i][0],latlng[i][1]])
        .bindPopup(`
        <div class="d-flex">
            <ul class="list-group list-group-flush">  
                <li class="list-group-item p-0 pl-1">Lokasi         : ${properties[i].Lokasi} (${properties[i].No})</li>
                <li class="list-group-item p-0 pl-1">Nadzir Wakaf   : ${properties[i].nadzir}</li>
                <ul class="list-group list-group-flush">  
                    <li class="list-group-item p-0 pl-3">Jabatan   : ${properties[i].jabatan} </li>
                    <li class="list-group-item p-0 pl-3">Tupoksi  : ${properties[i].tupoksi} </li>
                    <li class="list-group-item p-0 pl-3">Surat Keterangan   : ${properties[i].sk} </li>
                    <li class="list-group-item p-0 pl-3">Alamat   : ${properties[i].alamat} </li>
                    <li class="list-group-item p-0 pl-3">Status Nadzir  : ${properties[i].statusNadzir} </li>
                </ul>
                <li class="list-group-item p-0 pl-1">Kondisi Awal   : ${properties[i].Tipe} </li>
                <li class="list-group-item p-0 pl-1">Status         : ${properties[i].Status} </li>
                <li class="list-group-item p-0 pl-1">Luas Dahulu    : ${properties[i].LuasDahulu} m²</li>
                <li class="list-group-item p-0 pl-1">Luas Sekarang  : ${properties[i].LuasSekarang} m²</li>
                <div class="card-body p-0 pl-1 ">
                    <a href="${properties[i].GoogleEarth}" target="_blank" class="card-link">Cek Kondisi Sekarang</a>
                </div>
            </ul>
        </div>
            
            `).addTo(drawnItems);
        };
    console.log('Properties:', properties);
    // console.log('Marker:', marker);
    console.log('Markertanah:',markertanah);
    // console.log('koordinat:',latlng);
    // console.log('length :', markertanah.length);
    // var latlngs = JSON.parse($("name=polygon").val());
    // var polygon = L.polygon(latlngs,{color:'red'}).addTo(drawnItems);
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
        draw:{
            polyline:false,
            rectangle:false,
            circle:false,
            circlemarker:false
        },
        edit: {
            featureGroup: drawnItems,
        }
    });
    map.addControl(drawControl);
    
    map.on('draw:created',function (e) {
        var type = e.layerType,
        layer = e.layer;
        if (type === 'marker'){
            console.log(layer)
            var latlng = layer.getLatLng()
            console.log(latlng)
            var latitude = latlng.lat;
            var longitude = latlng.lng;
            var marker = L.marker({lat :latitude, lon : longitude}).bindPopup('This is Sumedang').addTo(map);
            console.log(marker)
        } else if (type === 'polygon'){
            console.log(layer)
            var latlng=layer.getLatLngs()[0];
            console.log(latlng)
            console.log("created")
            $("[name=polygon]").val(JSON.stringify(latlng));
            // Do whatever else you need to. (save to db; add to map etc)
            drawnItems.addLayer(layer);
        }
    });
    
    var geojson = L.geoJson(data,{
        style : style,
        onEachFeature:onEachFeature,
    }).addTo(map);

    var geojson2 = L.geoJson(data1,{
        style : style,
        onEachFeature:onEachFeature,
    }).addTo(map);

    function highlightFeature(e){
        var layer = e.target;
        
        layer.setStyle({
            weight:2,
            color:'#ff0000',
            dashArray:'',
            fillOpacity:0.7
        });

        if (!L.Browser.ie && L.Browser.opera && L.Browser.edge){
            layer.bringToFront();
        }

        info.update(layer.feature.properties);
    }

    function resetHighlight(e){
        geojson.resetStyle(e.target);
        info.update();
    }

    var info = L.control();

    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
        this.update();
        return this._div;
    };

    // method that we will use to update the control based on feature properties passed
    info.update = function (props) {
            this._div.innerHTML = '<h4>Sistem Informasi Geografis Tanah Wakaf YPS</h4>' +  (props ?
            '<b> Kecamatan \t: ' + props.Lokasi + '</b><br/>' + '<a> Peninggalan \t:' + props.jumlahtanahwakaf + ' Tanah Wakaf </a><br/>' 
            + '<a> Luas : ' + props.luas + ' m² </a>'    
            : 'Hover over a state');
    };

    info.addTo(map);

    var legend = L.control({position: 'bottomright'});

    legend.onAdd = function (map) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, 2.563305415, 18.10336118],
            labels = [];

        // loop through our density intervals and generate a label with a colored square for each interval
        for (var i = 0; i < grades.length; i++) {
            div.innerHTML +=
                '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
                grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
        }

        return div;
    };

    legend.addTo(map);
</script>
<?= $this->endSection()?>