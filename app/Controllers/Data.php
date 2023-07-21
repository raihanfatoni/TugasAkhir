<?php namespace App\Controllers;

class Data extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function index()
    {
        $dataModel = new \App\Models\DataModel();

        $data = $dataModel->select('*')
                ->join('master_data','data.id_master_data=master_data.id')
                ->join('kode_wilayah','data.kode_wilayah=kode_wilayah.kode_wilayah')
                ->orderBy('data.id_master_data','asc')
                ->get();
        return view('data/index',[
            'data'=> $data,
        ]);
    }

    public function import()
    {
        if($this->request->getPost()){
            $filename = $_FILES["csv"]["tmp_name"];
            
            if($_FILES['csv']['size']>0)
            {
                $file = fopen($filename, "r");
                // Ambil Nama Master Data (CSV)
                $modelMasterData = new \App\Models\MasterDataModel();
                $dataMaster = [
                    'nama'=> $this->request->getPost('nama')
                ];
                $modelMasterData->save($dataMaster);
                $idMasterData = $modelMasterData->insertID();

                // Insert Data CSV ke Database
                $model = new \App\Models\DataModel();
                $builder = $model->builder();
                $data = array();

                while(! feof($file))
                {
                    $column = fgetcsv($file,1000,";");

                    $kode_wilayah = $column[0];
                    $nilai = $column[1];

                    $row = [
                        'id_master_data'=> $idMasterData,
                        'kode_wilayah' => $kode_wilayah,
                        'nilai'=> $nilai,
                    ];

                    array_push($data,$row);
                }
                $builder->insertBatch($data);
                fclose($file);
            }
            return redirect()->to(site_url('Data/index'));
        }
        return view('data/import');
    }
}