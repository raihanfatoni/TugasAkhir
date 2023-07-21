<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('main');
	}

	public function Admin()
	{
		return view('tanah_view');
	}

	public function Login()
	{
		return view('login');
	}

	public function Maps()
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
		$model = new \App\Models\DataModel();

		$fileName = "http://localhost/tugasakhir/public/maps/prov.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);

		$features = $file->features;

		$idMasterData = 3;
		if($this->request->getPost())
		{
			$idMasterData = $this->request->getPost('master');
			console_log($idMasterData);
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
		console_log($allMasterData);

		foreach($allMasterData as $md)
		{
			$masterDataMenu[$md->id] = $md->nama;
		}
		console_log($features);
		console_log($nilaiMax);
		console_log($masterData);
		console_log($masterDataMenu);
		

		return view('maps/index',[
			'data'=> $features,
			'nilaiMax'=>$nilaiMax,
			'masterData'=> $masterData,
			'masterDataMenu'=>$masterDataMenu,
		]);
	}


	//--------------------------------------------------------------------

}
