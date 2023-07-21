<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TanahModel;
use App\Models\KecamatanModel;
use App\Models\NadzirModel;

class Tanah extends Controller
{
    public function index()
    {
        helper('form');
        $model = new TanahModel();
        $data['tanah'] = $model->getTanah();
        echo view('tanah_view', $data);
    }
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    public function formpolygon(){

        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        $model = new TanahModel();
        $tanah = $model->getTanah();
        // console_log($data);
        helper('form');
        foreach($tanah as $index=>$value)
		{
            if($value['polygon'] != NULL){
                $polygontanah[] = json_decode($value['polygon']);
                $no[] = json_decode($value['No']);
                $lokasi[] = $value['Lokasi'];
                $luasdahulu[] = json_decode($value['LuasDahulu']);
                $luasbau[] = json_decode($value['LuasDalamBau']);
                $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                $luassekarang[] = json_decode($value['LuasSekarang']);
                $nadzirwakaf[] = $value['NadzirWakaf'];
            }
        }
        $data = NULL;
        foreach($polygontanah as $row=>$val){
            foreach($polygontanah[$row] as $rows=>$vl){
                $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                $data['geometry'] = [
                    "type" => "Polygon",
                    "coordinates" => [$polygon[$row]]
                ];
            }
            $data['type'] = "Feature";
            $data['properties'] = [
                "No"=> $no[$row],
                "Lokasi"=> $lokasi[$row],
                "LuasDahulu"=> $luasdahulu[$row],
                "LuasBau"=> $luasbau[$row],
                "LuasMeter"=> $luasmeter[$row],
                "LuasTumbak"=> $luastumbak[$row],
                "LuasSekarang"=> $luassekarang[$row],
                "NadzirWakaf"=> $nadzirwakaf[$row],
            ];
            $response1[]=$data;  //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];
            
        }

		$model = new \App\Models\DataModel();

		$fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        console_log($features);

		$idMasterData = 3;
		if($this->request->getPost())
		{
			$idMasterData = $this->request->getPost('master');
		}

        foreach($tanah as $index=>$value)
        {
            if($value['marker'] != NULL){
                $markertanah[] = json_decode($value['marker']);
                $no[] = json_decode($value['No']);
                $lokasi[] = $value['Lokasi'];
                $status[] = $value['KoordinatLokasi'];
                $tipe[] = $value['Tipe'];
                $luasdahulu[] = json_decode($value['LuasDahulu']);
                $luasbau[] = json_decode($value['LuasDalamBau']);
                $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                $luassekarang[] = json_decode($value['LuasSekarang']);
                $nadzirwakaf[] = $value['NadzirWakaf'];
                $googleearth[] = $value['googleearth'];
            } 
        }
        foreach($markertanah as $row=>$val){
            $marker[$row] = [$val->lat, $val->lng];

            $data = NULL;
            $data['type'] = "Feature";
            $data['geometry'] = [
                "type" => "Marker",
                "coordinates" => $marker[$row]
            ];
            $data['properties'] = [
                "No"=> $no[$row],
                "Lokasi"=> $lokasi[$row],
                "Status"=> $status[$row],
                "Tipe"=>$tipe[$row],
                "LuasDahulu"=> $luasdahulu[$row],
                "LuasBau"=> $luasbau[$row],
                "LuasMeter"=> $luasmeter[$row],
                "LuasTumbak"=> $luastumbak[$row],
                "LuasSekarang"=> $luassekarang[$row],
                "NadzirWakaf"=> $nadzirwakaf[$row],
                "GoogleEarth"=> $googleearth[$row],

            ];
            $response[]=$data;
        }
        console_log($response);

		// foreach($features as $index=>$feature)
		// {
		// 	$kode_wilayah = $feature->properties->kode;
		// 	$data = $model->where('id_master_data', $idMasterData)
		// 			->where('kode_wilayah', $kode_wilayah)
		// 			->first();
		// 	if($data)
		// 	{
		// 		$features[$index]->properties->nilai = $data->nilai;
		// 	}

		// }
		$nilaiMax = $model->select('MAX(nilai) AS nilai')
					->where('id_master_data', $idMasterData)
					->first()->nilai;
		
		$masterDataModel = new \App\Models\MasterDataModel();
		$masterData = $masterDataModel->find($idMasterData);

		$allMasterData = $masterDataModel->findAll();

		$masterDataMenu=[];

		foreach($allMasterData as $md)
		{
			$masterDataMenu[$md->id] = $md->nama;
		}
		console_log($response1);

		return view('form/index',[
            'data'=> $features,
            'marker'=>$response,
            'data1'=>$response1,
            'nilaiMax'=>$nilaiMax,
            'masterData'=> $masterData,
            'masterDataMenu'=>$masterDataMenu,
		]);

    }

    public function formmarker(){

        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        $model = new TanahModel();
        $data = $model->getTanah();
        // console_log($data);
        helper('form');

        foreach($data as $index=>$value)
		{
            $polygon[$index] = $value['polygon'];
		}
        console_log($polygon);
		$model = new \App\Models\DataModel();

		$fileName = "http://localhost/tugasakhir/public/maps/prov.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        console_log($features);

		$idMasterData = 3;
		if($this->request->getPost())
		{
			$idMasterData = $this->request->getPost('master');
		}

		foreach($features as $index=>$feature)
		{
			$kode_wilayah = $feature->properties->kode;
			$data = $model->where('id_master_data', $idMasterData)
					->where('kode_wilayah', $kode_wilayah)
					->first();
			if($data)
			{
				$features[$index]->properties->nilai = $data->nilai;
			}

		}
		$nilaiMax = $model->select('MAX(nilai) AS nilai')
					->where('id_master_data', $idMasterData)
					->first()->nilai;
		
		$masterDataModel = new \App\Models\MasterDataModel();
		$masterData = $masterDataModel->find($idMasterData);

		$allMasterData = $masterDataModel->findAll();

		$masterDataMenu=[];

		foreach($allMasterData as $md)
		{
			$masterDataMenu[$md->id] = $md->nama;
		}
		

		return view('form/marker',[
            'polygon'=>$polygon,
			'data'=> $features,
			'nilaiMax'=>$nilaiMax,
			'masterData'=> $masterData,
			'masterDataMenu'=>$masterDataMenu,
		]);

    }

    public function polygontanahwakaf(){

        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        $model = new TanahModel();
        $tanah = $model->getTanah();
        // console_log($tanah);
		foreach($tanah as $index=>$value)
		{
            if($value['polygon'] != NULL){
                $polygontanah[] = json_decode($value['polygon']);
                $no[] = json_decode($value['No']);
                $lokasi[] = $value['Lokasi'];
                $luasdahulu[] = json_decode($value['LuasDahulu']);
                $luasbau[] = json_decode($value['LuasDalamBau']);
                $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                $luassekarang[] = json_decode($value['LuasSekarang']);
                $nadzirwakaf[] = $value['NadzirWakaf'];
            }
        }
        $data = NULL;
        foreach($polygontanah as $row=>$val){
            foreach($polygontanah[$row] as $rows=>$vl){
                $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                $data['geometry'] = [
                    "type" => "Polygon",
                    "coordinates" => [$polygon[$row]]
                ];
            }
            $data['type'] = "Feature";
            $data['properties'] = [
                "No"=> $no[$row],
                "Lokasi"=> $lokasi[$row],
                "LuasDahulu"=> $luasdahulu[$row],
                "LuasBau"=> $luasbau[$row],
                "LuasMeter"=> $luasmeter[$row],
                "LuasTumbak"=> $luastumbak[$row],
                "LuasSekarang"=> $luassekarang[$row],
                "NadzirWakaf"=> $nadzirwakaf[$row],
            ];
            $response[]=$data;  //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];
            
        }
        console_log($polygon);
        // console_log($polygontanah);
        // console_log($response);
        // console_log($latlngs);
        // $latlngs = json_encode($latlngs);
        // console_log($latlngs);

        helper('form');
		$model = new \App\Models\DataModel();

		$fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        console_log($features);

		$idMasterData = 3;
		if($this->request->getPost())
		{
			$idMasterData = $this->request->getPost('master');
		}


		// foreach($features as $index=>$feature)
		// {
		// 	$kode_wilayah = $feature->properties->kode;
		// 	$data = $model->where('id_master_data', $idMasterData)
		// 			->where('kode_wilayah', $kode_wilayah)
		// 			->first();
		// 	if($data)
		// 	{
		// 		$features[$index]->properties->nilai = $data->nilai;
		// 	}

		// }
		$nilaiMax = $model->select('MAX(nilai) AS nilai')
					->where('id_master_data', $idMasterData)
					->first()->nilai;
		
		$masterDataModel = new \App\Models\MasterDataModel();
		$masterData = $masterDataModel->find($idMasterData);

		$allMasterData = $masterDataModel->findAll();

		$masterDataMenu=[];

		foreach($allMasterData as $md)
		{
			$masterDataMenu[$md->id] = $md->nama;
		}
        console_log($features);
        console_log($response);
		

		return view('tanahwakaf/index',[
            'data'=> $response,
            'data1'=> $features,
			'nilaiMax'=>$nilaiMax,
			'masterData'=> $masterData,
			'masterDataMenu'=>$masterDataMenu,
		]);
        
    }
    
    public function polygonsumedang(){
        
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
            ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }
        
        $model = new TanahModel();
        $tanah = $model->getTanah();
        console_log($tanah);
        
        $fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
        $file = file_get_contents($fileName);
        $file = json_decode($file);
        // console_log($file);
        $features = $file->features;
        console_log($features);
        
        helper('form');
        $model = new \App\Models\DataModel();

        $modelKecamatan = new KecamatanModel;
        $kecamatan = $modelKecamatan->getKecamatan();
        console_log($kecamatan);

        $modelNadzir = new NadzirModel;
        $nadzir = $modelNadzir->getNadzir();
        console_log($nadzir);
        
        $idMasterData = 3;
        if($this->request->getPost())
        {
            $idMasterData = $this->request->getPost('master');
        }
        $nilaiMax = 10697;
        
        $masterDataModel = new \App\Models\MasterDataModel();
        $masterData = $masterDataModel->find($idMasterData);
        
        $allMasterData = $masterDataModel->findAll();
        console_log($allMasterData);
        
        $masterDataMenu=[];
        
        foreach($allMasterData as $md)
        {
            $masterDataMenu[$md->id] = $md->nama;
        }

        // Logic untuk menampilkan data berdasarkan isi array $tipeTanah, $namaTanah dan $namaKecamatan
        $tipeTanah = ['SEMUA','SAWAH','DARAT','BANGUNAN']; // Isi dropdown $tipeTanah
        $namaTanah = [];
        foreach($tanah as $index=>$value){
            if($value['marker'] != NULL){
                $namaTanah[$value['Lokasi']] = $value['Lokasi']; // Assign seluruh row pada database yang berupa marker 
            }
        }
        console_log($namaTanah); // Isi dropdown $namaTanah
        $namaKecamatan = [];
        foreach($kecamatan as $index=>$value){
            $namaKecamatan[$value['id_kecamatan']] = $value['nama'];
        }
        console_log($namaKecamatan);
        $pilihKecamatan = '';
        if($this->request->getPost('kecamatan'))
        {
            $pilihKecamatan = $this->request->getPost('kecamatan');
            console_log($pilihKecamatan);
            foreach($tanah as $index=>$value)
            {
                if($value['marker'] != NULL && $value['id_kecamatan'] == $pilihKecamatan){ // Assign seluruh row marker yang memenuhi kondisi
                    $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                    $no[] = json_decode($value['No']);               // menjadi objek
                    $lokasi[] = $value['Lokasi'];
                    $status[] = $value['KoordinatLokasi'];
                    $tipe[] = $value['Tipe'];
                    $luasdahulu[] = json_decode($value['LuasDahulu']);
                    $luasbau[] = json_decode($value['LuasDalamBau']);
                    $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                    $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                    $luassekarang[] = json_decode($value['LuasSekarang']);
                    $nadzirwakaf[] = $value['NadzirWakaf'];
                    $googleearth[] = $value['googleearth'];
                } 
            }
            foreach($markertanah as $row=>$val){ // Loop ini bertujuan untuk mengubah format return data menjadi bentuk geoJSON
                $marker[$row] = [$val->lat, $val->lng];
    
                $data = NULL;
                $data['type'] = "Feature";
                $data['geometry'] = [
                    "type" => "Marker",
                    "coordinates" => $marker[$row]
                ];
                $data['properties'] = [
                    "No"=> $no[$row],
                    "Lokasi"=> $lokasi[$row],
                    "Status"=> $status[$row],
                    "Tipe"=>$tipe[$row],
                    "LuasDahulu"=> $luasdahulu[$row],
                    "LuasBau"=> $luasbau[$row],
                    "LuasMeter"=> $luasmeter[$row],
                    "LuasTumbak"=> $luastumbak[$row],
                    "LuasSekarang"=> $luassekarang[$row],
                    "NadzirWakaf"=> $nadzirwakaf[$row],
                    "GoogleEarth"=> $googleearth[$row],
    
                ];
                $response[]=$data;
            }

            foreach($response as $index=>$feature){
                $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                console_log($NadzirWakaf);
                $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                        ->first();
                if($data)
                {
                    $response[$index]['properties']['nadzir'] = $data['nama'];
                    $response[$index]['properties']['jabatan'] = $data['jabatan'];
                    $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                    $response[$index]['properties']['alamat'] = $data['alamat'];
                    $response[$index]['properties']['sk'] = $data['sk'];
                    $response[$index]['properties']['status'] = $data['status'];

                }
                
            }
            console_log($response);
            console_log($tipeTanah);

            // $dataKecamatan = $modelKecamatan->getKecamatan();
            // console_log($dataKecamatan);
            
            foreach($tanah as $index=>$value)

            {
                if($value['polygon'] != NULL){
                    $polygontanah[] = json_decode($value['polygon']);
                    $nomor[] = json_decode($value['No']);
                    $kelurahan[] = $value['Lokasi'];
                }
            }
            $data = NULL;
            foreach($polygontanah as $row=>$val){
                foreach($polygontanah[$row] as $rows=>$vl){
                    $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                    $data['geometry'] = [
                        "type" => "Polygon",
                        "coordinates" => [$polygon[$row]]
                    ];
                    $data['type'] = "Feature";
                    $data['properties'] = [
                        "No"=> $nomor[$row],
                        "Lokasi"=> $kelurahan[$row]
                    ];
                }
            
                $response1[]=$data;  //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];
                
            }
            foreach($response1 as $index=>$feature){
                $no = $feature['properties']['No'];
                console_log($no);
                $data = $modelKecamatan->where('id_kecamatan', $no)
                        ->first();
                if($data)
                {
                    $response1[$index]['properties']['luas'] = $data['luas'];
                    $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                }
                
            }

            console_log($response1);

            return view('polygon/index',[
                'data'=> $features,
                'data1'=> $response1,
                'marker'=>$response,
                'nilaiMax'=>$nilaiMax,
                'masterData'=> $masterData,
                'masterDataMenu'=>$masterDataMenu,
                'tipeTanah' =>$tipeTanah,
                'namaTanah' =>$namaTanah,
                'namaKecamatan'=>$namaKecamatan,
            ]); 
        }

        // Logic untuk menampilkan marker pada peta digital berdasarkan lokasi yang dipilih
        $pilihTanah = '';
        if($this->request->getPost('tanah')) // Kondisi ini akan dieksekusi jika user melakukan POST pada dropdown dengan name ='tanah'
        {
            $pilihTanah = $this->request->getPost('tanah');
            console_log($pilihTanah);
            foreach($tanah as $index=>$value)
            {
                if($value['marker'] != NULL && $value['Lokasi'] == $pilihTanah){ // Assign seluruh row marker yang memenuhi kondisi
                    $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                    $no[] = json_decode($value['No']);               // menjadi objek
                    $lokasi[] = $value['Lokasi'];
                    $status[] = $value['KoordinatLokasi'];
                    $tipe[] = $value['Tipe'];
                    $luasdahulu[] = json_decode($value['LuasDahulu']);
                    $luasbau[] = json_decode($value['LuasDalamBau']);
                    $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                    $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                    $luassekarang[] = json_decode($value['LuasSekarang']);
                    $nadzirwakaf[] = $value['NadzirWakaf'];
                    $googleearth[] = $value['googleearth'];
                } 
            }
            foreach($markertanah as $row=>$val){ // Loop ini bertujuan untuk mengubah format return data menjadi bentuk geoJSON
                $marker[$row] = [$val->lat, $val->lng];
    
                $data = NULL;
                $data['type'] = "Feature";
                $data['geometry'] = [
                    "type" => "Marker",
                    "coordinates" => $marker[$row]
                ];
                $data['properties'] = [
                    "No"=> $no[$row],
                    "Lokasi"=> $lokasi[$row],
                    "Status"=> $status[$row],
                    "Tipe"=>$tipe[$row],
                    "LuasDahulu"=> $luasdahulu[$row],
                    "LuasBau"=> $luasbau[$row],
                    "LuasMeter"=> $luasmeter[$row],
                    "LuasTumbak"=> $luastumbak[$row],
                    "LuasSekarang"=> $luassekarang[$row],
                    "NadzirWakaf"=> $nadzirwakaf[$row],
                    "GoogleEarth"=> $googleearth[$row],
    
                ];
                $response[]=$data;
            }
            foreach($response as $index=>$feature){
                $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                ->first();
                if($data)
                {
                    $response[$index]['properties']['nadzir'] = $data['nama'];
                    $response[$index]['properties']['jabatan'] = $data['jabatan'];
                    $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                    $response[$index]['properties']['alamat'] = $data['alamat'];
                    $response[$index]['properties']['sk'] = $data['sk'];
                    $response[$index]['properties']['statusNadzir'] = $data['status'];
                    
                }
                
            }
            console_log($response);
            console_log($tipeTanah);

            // $dataKecamatan = $modelKecamatan->getKecamatan();
            // console_log($dataKecamatan);
            
            foreach($tanah as $index=>$value)

            {
                if($value['polygon'] != NULL){
                    $polygontanah[] = json_decode($value['polygon']);
                    $nomor[] = json_decode($value['No']);
                    $kelurahan[] = $value['Lokasi'];
                }
            }
            $data = NULL;
            foreach($polygontanah as $row=>$val){
                foreach($polygontanah[$row] as $rows=>$vl){
                    $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                    $data['geometry'] = [
                        "type" => "Polygon",
                        "coordinates" => [$polygon[$row]]
                    ];
                    $data['type'] = "Feature";
                    $data['properties'] = [
                        "No"=> $nomor[$row],
                        "Lokasi"=> $kelurahan[$row]
                    ];
                }
            
                $response1[]=$data;  //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];
                
            }
            foreach($response1 as $index=>$feature){
                $no = $feature['properties']['No'];
                console_log($no);
                $data = $modelKecamatan->where('id_kecamatan', $no)
                        ->first();
                if($data)
                {
                    $response1[$index]['properties']['luas'] = $data['luas'];
                    $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                }
                
            }
            console_log($response1);

            return view('polygon/index',[
                'data'=> $features,
                'data1'=> $response1,
                'marker'=>$response,
                'nilaiMax'=>$nilaiMax,
                'masterData'=> $masterData,
                'masterDataMenu'=>$masterDataMenu,
                'tipeTanah' =>$tipeTanah,
                'namaTanah' =>$namaTanah,
                'namaKecamatan'=>$namaKecamatan,
            ]); 
        }
        // Logic untuk menampilkan marker pada peta digital berdasarkan jenis tanah yang dipilih
        $pilihTipe = 0;
        if($this->request->getPost('tipe')) // Kondisi ini akan dieksekusi jika user melakukan POST pada dropdown dengan name = 'tipe'
		{
			$pilihTipe = $this->request->getPost('tipe');
            console_log($pilihTipe);
		}
        switch ($pilihTipe){ // $pilihTipe akan berisikan index dari isi array $tipeTanah
            case 0: // Kondisi jika menampilkan seluruh marker pada peta digital ($pilihTipe = 0)
                foreach($tanah as $index=>$value) 
                {
                    if($value['marker'] != NULL){
                        $markertanah[] = json_decode($value['marker']);
                        $no[] = json_decode($value['No']);
                        $lokasi[] = $value['Lokasi'];
                        $status[] = $value['KoordinatLokasi'];
                        $tipe[] = $value['Tipe'];
                        $luasdahulu[] = json_decode($value['LuasDahulu']);
                        $luasbau[] = json_decode($value['LuasDalamBau']);
                        $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                        $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                        $luassekarang[] = json_decode($value['LuasSekarang']);
                        $nadzirwakaf[] = $value['NadzirWakaf'];
                        $googleearth[] = $value['googleearth'];
                    } 
                }
                console_log($markertanah);
                foreach($markertanah as $row=>$val){ // Loop ini bertujuan untuk mengubah format return data menjadi bentuk geoJSON
                    $marker[$row] = [$val->lat, $val->lng];
        
                    $data = NULL;
                    $data['type'] = "Feature";
                    $data['geometry'] = [
                        "type" => "Marker",
                        "coordinates" => $marker[$row]
                    ];
                    $data['properties'] = [
                        "No"=> $no[$row],
                        "Lokasi"=> $lokasi[$row],
                        "Status"=> $status[$row],
                        "Tipe"=>$tipe[$row],
                        "LuasDahulu"=> $luasdahulu[$row],
                        "LuasBau"=> $luasbau[$row],
                        "LuasMeter"=> $luasmeter[$row],
                        "LuasTumbak"=> $luastumbak[$row],
                        "LuasSekarang"=> $luassekarang[$row],
                        "NadzirWakaf"=> $nadzirwakaf[$row],
                        "GoogleEarth"=> $googleearth[$row],
        
                    ];
                    $response[]=$data;
                }
                console_log($tipeTanah);
                
                foreach($response as $index=>$feature){
                    $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                    $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                    ->first();
                    if($data)
                    {
                        $response[$index]['properties']['nadzir'] = $data['nama'];
                        $response[$index]['properties']['jabatan'] = $data['jabatan'];
                        $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                        $response[$index]['properties']['alamat'] = $data['alamat'];
                        $response[$index]['properties']['sk'] = $data['sk'];
                        $response[$index]['properties']['statusNadzir'] = $data['status'];
                        
                    }
                    
                }
                console_log($response);

                foreach($tanah as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $nomor[] = json_decode($value['No']);
                        $kelurahan[] = $value['Lokasi'];
                    }
                }
                $data = NULL;
                foreach($polygontanah as $row=>$val){
                    foreach($polygontanah[$row] as $rows=>$vl){
                        $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                        $data['geometry'] = [
                            "type" => "Polygon",
                            "coordinates" => [$polygon[$row]]
                        ];
                        $data['type'] = "Feature";
                        $data['properties'] = [
                            "No"=> $nomor[$row],
                            "Lokasi"=> $kelurahan[$row]
                        ];
                    }
                    $response1[]=$data;  //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];
                    
                }
                foreach($response1 as $index=>$feature){
                    $no = $feature['properties']['No'];
                    console_log($no);
                    $data = $modelKecamatan->where('id_kecamatan', $no)
                            ->first();
                    if($data)
                    {
                        $response1[$index]['properties']['luas'] = $data['luas'];
                        $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                    }
                    
                }
                console_log($response1);

                return view('polygon/index',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'masterData'=> $masterData,
                    'masterDataMenu'=>$masterDataMenu,
                    'tipeTanah' =>$tipeTanah,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                ]); 
                break;
            case 1: // Kondisi jika menampilkan tanah sawah pada peta digital ($pilihTipe = 1)
                foreach($tanah as $index=>$value) // Assign seluruh marker pada database dengan tipe 'Sawah'
                {
                    if($value['marker'] != NULL && $value['Tipe'] == 'Sawah'){
                        $markertanah[] = json_decode($value['marker']);
                        $no[] = json_decode($value['No']);
                        $lokasi[] = $value['Lokasi'];
                        $status[] = $value['KoordinatLokasi'];
                        $tipe[] = $value['Tipe'];
                        $luasdahulu[] = json_decode($value['LuasDahulu']);
                        $luasbau[] = json_decode($value['LuasDalamBau']);
                        $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                        $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                        $luassekarang[] = json_decode($value['LuasSekarang']);
                        $nadzirwakaf[] = $value['NadzirWakaf'];
                        $googleearth[] = $value['googleearth'];
                    } 
                }
                foreach($markertanah as $row=>$val){ // Loop ini bertujuan untuk mengubah format return data menjadi bentuk geoJSON
                    $marker[$row] = [$val->lat, $val->lng];
        
                    $data = NULL;
                    $data['type'] = "Feature";
                    $data['geometry'] = [
                        "type" => "Marker",
                        "coordinates" => $marker[$row]
                    ];
                    $data['properties'] = [
                        "No"=> $no[$row],
                        "Lokasi"=> $lokasi[$row],
                        "Status"=> $status[$row],
                        "Tipe"=>$tipe[$row],
                        "LuasDahulu"=> $luasdahulu[$row],
                        "LuasBau"=> $luasbau[$row],
                        "LuasMeter"=> $luasmeter[$row],
                        "LuasTumbak"=> $luastumbak[$row],
                        "LuasSekarang"=> $luassekarang[$row],
                        "NadzirWakaf"=> $nadzirwakaf[$row],
                        "GoogleEarth"=> $googleearth[$row],
        
                    ];
                    $response[]=$data;
                }
                foreach($response as $index=>$feature){
                    $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                    $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                    ->first();
                    if($data)
                    {
                        $response[$index]['properties']['nadzir'] = $data['nama'];
                        $response[$index]['properties']['jabatan'] = $data['jabatan'];
                        $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                        $response[$index]['properties']['alamat'] = $data['alamat'];
                        $response[$index]['properties']['sk'] = $data['sk'];
                        $response[$index]['properties']['statusNadzir'] = $data['status'];
                        
                    }
                    
                }
                console_log($response);
                console_log($tipeTanah);

                foreach($tanah as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $nomor[] = json_decode($value['No']);
                        $kelurahan[] = $value['Lokasi'];
                    }
                }
                $data = NULL;
                foreach($polygontanah as $row=>$val){
                    foreach($polygontanah[$row] as $rows=>$vl){
                        $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                        $data['geometry'] = [
                            "type" => "Polygon",
                            "coordinates" => [$polygon[$row]]
                        ];
                        $data['type'] = "Feature";
                        $data['properties'] = [
                            "No"=> $nomor[$row],
                            "Lokasi"=> $kelurahan[$row]
                        ];
                    }
                    $response1[]=$data;  //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];
                    
                }
                foreach($response1 as $index=>$feature){
                    $no = $feature['properties']['No'];
                    console_log($no);
                    $data = $modelKecamatan->where('id_kecamatan', $no)
                            ->first();
                    if($data)
                    {
                        $response1[$index]['properties']['luas'] = $data['luas'];
                        $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                    }
                    
                }

                console_log($response1);

                return view('polygon/index',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'masterData'=> $masterData,
                    'masterDataMenu'=>$masterDataMenu,
                    'tipeTanah' =>$tipeTanah,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                ]); 
                break;
            case 2: // Kondisi jika menampilkan tanah sawah pada peta digital ($pilihTipe = 2)
                foreach($tanah as $index=>$value) // Assign seluruh marker dengan tipe 'Darat'
                {
                    if($value['marker'] != NULL && $value['Tipe'] == 'Darat'){
                        $markertanah[] = json_decode($value['marker']);
                        $no[] = json_decode($value['No']);
                        $lokasi[] = $value['Lokasi'];
                        $status[] = $value['KoordinatLokasi'];
                        $tipe[] = $value['Tipe'];
                        $luasdahulu[] = json_decode($value['LuasDahulu']);
                        $luasbau[] = json_decode($value['LuasDalamBau']);
                        $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                        $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                        $luassekarang[] = json_decode($value['LuasSekarang']);
                        $nadzirwakaf[] = $value['NadzirWakaf'];
                        $googleearth[] = $value['googleearth'];
                    } 
                }
                foreach($markertanah as $row=>$val){ // Loop ini bertujuan untuk mengubah format return data menjadi bentuk geoJSON
                    $marker[$row] = [$val->lat, $val->lng];
        
                    $data = NULL;
                    $data['type'] = "Feature";
                    $data['geometry'] = [
                        "type" => "Marker",
                        "coordinates" => $marker[$row]
                    ];
                    $data['properties'] = [
                        "No"=> $no[$row],
                        "Lokasi"=> $lokasi[$row],
                        "Status"=> $status[$row],
                        "Tipe"=>$tipe[$row],
                        "LuasDahulu"=> $luasdahulu[$row],
                        "LuasBau"=> $luasbau[$row],
                        "LuasMeter"=> $luasmeter[$row],
                        "LuasTumbak"=> $luastumbak[$row],
                        "LuasSekarang"=> $luassekarang[$row],
                        "NadzirWakaf"=> $nadzirwakaf[$row],
                        "GoogleEarth"=> $googleearth[$row],
                        
                    ];
                    $response[]=$data;
                }
                foreach($response as $index=>$feature){
                    $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                    $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                    ->first();
                    if($data)
                    {
                        $response[$index]['properties']['nadzir'] = $data['nama'];
                        $response[$index]['properties']['jabatan'] = $data['jabatan'];
                        $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                        $response[$index]['properties']['alamat'] = $data['alamat'];
                        $response[$index]['properties']['sk'] = $data['sk'];
                        $response[$index]['properties']['statusNadzir'] = $data['status'];
                        
                    }
                    
                }
                console_log($response);
                console_log($tipeTanah);
                foreach($tanah as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $nomor[] = json_decode($value['No']);
                        $kelurahan[] = $value['Lokasi'];
                    }
                }
                $data = NULL;
                foreach($polygontanah as $row=>$val){
                    foreach($polygontanah[$row] as $rows=>$vl){
                        $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                        $data['geometry'] = [
                            "type" => "Polygon",
                            "coordinates" => [$polygon[$row]]
                        ];
                        $data['type'] = "Feature";
                        $data['properties'] = [
                            "No"=> $nomor[$row],
                            "Lokasi"=> $kelurahan[$row]
                        ];
                    }
                    $response1[]=$data;  //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];
                    
                }
                foreach($response1 as $index=>$feature){
                    $no = $feature['properties']['No'];
                    console_log($no);
                    $data = $modelKecamatan->where('id_kecamatan', $no)
                            ->first();
                    if($data)
                    {
                        $response1[$index]['properties']['luas'] = $data['luas'];
                        $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                    }
                    
                }
                console_log($response1);

                return view('polygon/index',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'masterData'=> $masterData,
                    'masterDataMenu'=>$masterDataMenu,
                    'tipeTanah' =>$tipeTanah,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                ]); 
                break;
                case 3: // Kondisi jika menampilkan tanah sawah pada peta digital ($pilihTipe = 3)
                    foreach($tanah as $index=>$value) // Assign seluruh marker dengan tipe 'Bangunan'
                    {
                        if($value['marker'] != NULL && $value['Tipe'] == 'Bangunan'){
                            $markertanah[] = json_decode($value['marker']);
                            $no[] = json_decode($value['No']);
                            $lokasi[] = $value['Lokasi'];
                            $status[] = $value['KoordinatLokasi'];
                            $tipe[] = $value['Tipe'];
                            $luasdahulu[] = json_decode($value['LuasDahulu']);
                            $luasbau[] = json_decode($value['LuasDalamBau']);
                            $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                            $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                            $luassekarang[] = json_decode($value['LuasSekarang']);
                            $nadzirwakaf[] = $value['NadzirWakaf'];
                            $googleearth[] = $value['googleearth'];
                        } 
                    }
                    foreach($markertanah as $row=>$val){ // Loop ini bertujuan untuk mengubah format return data menjadi bentuk geoJSON
                        $marker[$row] = [$val->lat, $val->lng];
            
                        $data = NULL;
                        $data['type'] = "Feature";
                        $data['geometry'] = [
                            "type" => "Marker",
                            "coordinates" => $marker[$row]
                        ];
                        $data['properties'] = [
                            "No"=> $no[$row],
                            "Lokasi"=> $lokasi[$row],
                            "Status"=> $status[$row],
                            "Tipe"=>$tipe[$row],
                            "LuasDahulu"=> $luasdahulu[$row],
                            "LuasBau"=> $luasbau[$row],
                            "LuasMeter"=> $luasmeter[$row],
                            "LuasTumbak"=> $luastumbak[$row],
                            "LuasSekarang"=> $luassekarang[$row],
                            "NadzirWakaf"=> $nadzirwakaf[$row],
                            "GoogleEarth"=> $googleearth[$row],
                            
                        ];
                        $response[]=$data;
                    }
                    foreach($response as $index=>$feature){
                        $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                        $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                        ->first();
                        if($data)
                        {
                            $response[$index]['properties']['nadzir'] = $data['nama'];
                            $response[$index]['properties']['jabatan'] = $data['jabatan'];
                            $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                            $response[$index]['properties']['alamat'] = $data['alamat'];
                            $response[$index]['properties']['sk'] = $data['sk'];
                            $response[$index]['properties']['statusNadzir'] = $data['status'];
                            
                        }
                        
                    }

                    console_log($response);
                    console_log($tipeTanah);

                    foreach($tanah as $index=>$value)
                    {
                        if($value['polygon'] != NULL){
                            $polygontanah[] = json_decode($value['polygon']);
                            $nomor[] = json_decode($value['No']);
                            $kelurahan[] = $value['Lokasi'];
                        }
                    }
                    $data = NULL;
                    foreach($polygontanah as $row=>$val){
                        foreach($polygontanah[$row] as $rows=>$vl){
                            $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                            $data['geometry'] = [
                                "type" => "Polygon",
                                "coordinates" => [$polygon[$row]]
                            ];
                            $data['type'] = "Feature";
                            $data['properties'] = [
                                "No"=> $nomor[$row],
                                "Lokasi"=> $kelurahan[$row]
                            ];
                        }
                        $response1[]=$data;  //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];
                        
                    }
                    foreach($response1 as $index=>$feature){
                        $no = $feature['properties']['No'];
                        console_log($no);
                        $data = $modelKecamatan->where('id_kecamatan', $no)
                                ->first();
                        if($data)
                        {
                            $response1[$index]['properties']['luas'] = $data['luas'];
                            $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                        }
                        
                    }
                    console_log($response1);
    
                    return view('polygon/index',[
                        'data'=> $features,
                        'data1'=> $response1,
                        'marker'=>$response,
                        'nilaiMax'=>$nilaiMax,
                        'masterData'=> $masterData,
                        'masterDataMenu'=>$masterDataMenu,
                        'tipeTanah' =>$tipeTanah,
                        'namaTanah' =>$namaTanah,
                        'namaKecamatan'=>$namaKecamatan,
                    ]); 
                    break;
            } 
        //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];    
    }
    public function formpolygonedit($id){

        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        $model = new TanahModel();
        $tanah = $model->getTanah($id)->getRow();
        console_log($tanah);
        $polygontanah = $tanah->polygon;
        $polygontanah = json_decode($polygontanah);
        console_log($polygontanah);
        console_log($tanah);
        helper('form');
		$model = new \App\Models\DataModel();

		$fileName = "http://localhost/tugasakhir/public/maps/prov.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        // $features = json_encode($features);
        console_log($features);

		$idMasterData = 3;
		if($this->request->getPost())
		{
			$idMasterData = $this->request->getPost('master');
		}

		foreach($features as $index=>$feature)
		{
			$kode_wilayah = $feature->properties->kode;
			$data = $model->where('id_master_data', $idMasterData)
					->where('kode_wilayah', $kode_wilayah)
					->first();
			if($data)
			{
				$features[$index]->properties->nilai = $data->nilai;
			}

		}
		$nilaiMax = $model->select('MAX(nilai) AS nilai')
					->where('id_master_data', $idMasterData)
					->first()->nilai;
		
		$masterDataModel = new \App\Models\MasterDataModel();
		$masterData = $masterDataModel->find($idMasterData);

		$allMasterData = $masterDataModel->findAll();

		$masterDataMenu=[];

		foreach($allMasterData as $md)
		{
			$masterDataMenu[$md->id] = $md->nama;
		}

		return view('form/edit',[
            'polygontanah'=>$polygontanah,
            'tanah'=>$tanah,
			'data'=> $features,
			'nilaiMax'=>$nilaiMax,
			'masterData'=> $masterData,
			'masterDataMenu'=>$masterDataMenu,
		]);

    }

    public function formmarkeredit($id){

        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        $model = new TanahModel();
        $tanah = $model->getTanah($id)->getRow();
        $markertanah = $tanah->marker;
        $markertanah = json_decode($markertanah);
        // $latitude = $markertanah->lat;
        // $longitude = $markertanah->lng;
        console_log($markertanah);
        // console_log($latitude);
        // console_log($longitude);
        console_log($tanah);
        helper('form');
		$model = new \App\Models\DataModel();


        $fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        console_log($features);

		$idMasterData = 3;
		if($this->request->getPost())
		{
			$idMasterData = $this->request->getPost('master');
		}

		// foreach($features as $index=>$feature)
		// {
		// 	$kode_wilayah = $feature->properties->kode;
		// 	$data = $model->where('id_master_data', $idMasterData)
		// 			->where('kode_wilayah', $kode_wilayah)
		// 			->first();
		// 	if($data)
		// 	{
		// 		$features[$index]->properties->nilai = $data->nilai;
		// 	}

		// }
		$nilaiMax = $model->select('MAX(nilai) AS nilai')
					->where('id_master_data', $idMasterData)
					->first()->nilai;
		
		$masterDataModel = new \App\Models\MasterDataModel();
		$masterData = $masterDataModel->find($idMasterData);

		$allMasterData = $masterDataModel->findAll();

		$masterDataMenu=[];

		foreach($allMasterData as $md)
		{
			$masterDataMenu[$md->id] = $md->nama;
		}

		return view('form/editmarker',[
            'markertanah'=>$markertanah,
            // 'latitude'=> $latitude,
            // 'longitude'=> $longitude,
            'tanah'=>$tanah,
			'data'=> $features,
			'nilaiMax'=>$nilaiMax,
			'masterData'=> $masterData,
			'masterDataMenu'=>$masterDataMenu,
		]);

    }

    public function add_new()
    {
        echo view('add_tanah');
    }

    public function save()
    {
        $model = new TanahModel();
        $data = array(
            'No'  => $this->request->getPost('No'),
            'Lokasi' => $this->request->getPost('Lokasi'),
            'Tipe' => $this->request->getPost('Tipe'),
            'LuasDahulu' => $this->request->getPost('LuasDahulu'),
            'LuasSekarang' => $this->request->getPost('LuasSekarang'),
            'LuasDalamBau' => $this->request->getPost('LuasDalamBau'),
            'LuasDalamTumbak' => $this->request->getPost('LuasDalamTumbak'),
            'LuasDalamMeterPersegi' => $this->request->getPost('LuasDalamMeterPersegi'),
            'NadzirWakaf' => $this->request->getPost('NadzirWakaf'),
            'KoordinatLokasi' => $this->request->getPost('KoordinatLokasi'),
            'polygon' => $this->request->getPost('polygon'),
            'marker' => $this->request->getPost('marker'),
            'googleearth' => $this->request->getPost('googleearth'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
        );  
        $model->saveTanah($data);
        return redirect()->to(base_url("tanah"));
    }

    public function edit($id)
    {
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }
        $model = new TanahModel();
        $data['tanah'] = $model->getTanah($id)->getRow();
        console_log($data);
        echo view('edit_tanah', $data);
    }

    public function update()
    {
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        $model = new TanahModel();
        $id = $this->request->getPost('No');
        $data = array(
            'No'  => $this->request->getPost('No'),
            'Lokasi' => $this->request->getPost('Lokasi'),
            'Tipe' => $this->request->getPost('Tipe'),
            'LuasDahulu' => $this->request->getPost('LuasDahulu'),
            'LuasSekarang' => $this->request->getPost('LuasSekarang'),
            'LuasDalamBau' => $this->request->getPost('LuasDalamBau'),
            'LuasDalamTumbak' => $this->request->getPost('LuasDalamTumbak'),
            'LuasDalamMeterPersegi' => $this->request->getPost('LuasDalamMeterPersegi'),
            'KoordinatLokasi' => $this->request->getPost('KoordinatLokasi'),
            'NadzirWakaf' => $this->request->getPost('NadzirWakaf'),
            'polygon' => $this->request->getPost('polygon'),
            'marker' => $this->request->getPost('marker'),
            'googleearth' => $this->request->getPost('googleearth'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
        );
        console_log($data);
        $model->updateTanah($data, $id);
        return redirect()->to(base_url("tanah"));
    }

    public function Search()
    {
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        helper('form');
        $model = new TanahModel();
        // $data['tanah'] = $model->getTanah();
        // echo view('tanah_view', $data);
        $keyword = $this->request->getPost('keyword');
        $data['tanah']= $model->getKeyword($keyword);
        console_log($data);
        echo view('tanah_view', $data);
    }

    public function delete($id)
    {
        $model = new TanahModel();
        $data['tanah'] = $model->getTanah($id)->getRow();
        $model->deleteTanah($id);
        return redirect()->to(base_url("tanah"));
    }
}
