<?php
    $dropdownMenu = [
        'name'=> 'master',
        'options'=> $masterDataMenu,
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
    <script src="http://localhost/tugasakhir/public/leaflet/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <link rel="stylesheet" href = "http://localhost/tugasakhir/public/leaflet/leaflet.css">
    <link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css">
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
    </style>
<?= $this->endSection()?>

<?= $this->section('content')?>
<div class="row">
    <div class="card">
        <div class="card-body">
            <?= form_open('Home/Maps') ?>
            <div class="row mt-3 mb-3">
                <div class="col-md-6">
                    <?= form_dropdown($dropdownMenu) ?>
                </div>
                <div class="col-md-6">
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
    var data = <?= json_encode($data) ?> 
    var nilaiMax = <?= $nilaiMax ?>

    function getColor(d) {
		return d > (nilaiMax/8)*7 ? '#800026' :
           d > (nilaiMax/8)*6  ? '#BD0026' :
           d > (nilaiMax/8)*5  ? '#E31A1C' :
           d > (nilaiMax/8)*4  ? '#FC4E2A' :
           d > (nilaiMax/8)*3   ? '#FD8D3C' :
           d > (nilaiMax/8)*2   ? '#FEB24C' :
           d > (nilaiMax/8)*1   ? '#FED976' :
                      '#FFEDA0';
    }

    function style(feature){
        return{
            weight : 2,
            opacity : 1,
            color : 'white',
            dashArray : '3',
            fillOpacity : 0.7,
            fillColor : getColor(parseInt(feature.properties.nilai))
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

    var map = L.map('maps').setView({lat : 0.7893, lon : 113.9213}, 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    L.marker({lat : -6.85861, lon : 107.91639}).bindPopup('This is Sumedang').addTo(map);

    var drawnItems = new L.FeatureGroup();
    // var latlngs = JSON.parse($("name=polygon").val());
    // var polygon = L.polygon(latlngs,{color:'red'}).addTo(drawnItems);
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
        draw:{
            polyline:false,
            rectangle:false,
            circle:false,
            marker:false,
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
        var latlng=layer.getLatLngs()[0];
        console.log(latlng)
        console.log("created")
        $("[name=polygon]").val(JSON.stringify(latlng));
        // Do whatever else you need to. (save to db; add to map etc)
        drawnItems.addLayer(layer);
    });
    
    var geojson = L.geoJson(data,{
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
        this._div.innerHTML = '<h4><?= $masterData->nama ?></h4>' +  (props ?
            '<b>' + props.Propinsi + '</b><br />' + props.nilai + ' 000 Jiwa'
            : 'Hover over a state');
    };

    info.addTo(map);

    var legend = L.control({position: 'bottomright'});

    legend.onAdd = function (map) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, (nilaiMax/8)*1, (nilaiMax/8)*2, (nilaiMax/8)*3, (nilaiMax/8)*4, (nilaiMax/8)*5, (nilaiMax/8)*6, (nilaiMax/8)*7],
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