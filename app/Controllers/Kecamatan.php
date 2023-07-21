<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KecamatanModel;

class Kecamatan extends Controller
{
    public function index()
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
        $model = new KecamatanModel();
        $data['kecamatan'] = $model->getKecamatan();
        console_log($data);
        echo view('kecamatan_view', $data);
    }

    public function add_new()
    {
        echo view('add_kecamatan');
    }

    public function save()
    {
        $model = new KecamatanModel();
        $data = array(
            'id_kecamatan'  => $this->request->getPost('id_kecamatan'),
            'nama' => $this->request->getPost('nama'),
            'luas' => $this->request->getPost('luas'),
            'jumlahtanah' => $this->request->getPost('jumlahtanah'),
        );  
        $model->saveKecamatan($data);
        return redirect()->to(base_url("kecamatan"));
    }

    public function edit($id)
    {
        $model = new KecamatanModel();
        $data['kecamatan'] = $model->getKecamatan($id)->getRow();
        echo view('edit_kecamatan', $data);
    }

    public function update()
    {
        $model = new KecamatanModel();
        $id = $this->request->getPost('id_kecamatan');
        $data = array(
            'id_kecamatan'  => $this->request->getPost('id_kecamatan'),
            'nama' => $this->request->getPost('nama'),
            'luas' => $this->request->getPost('luas'),
            'jumlahtanah' => $this->request->getPost('jumlahtanah'),

        );
        $model->updateKecamatan($data, $id);
        return redirect()->to(base_url("kecamatan"));
    }

    public function delete($id)
    {
        $model = new KecamatanModel();
        $data['kecamatan'] = $model->getKecamatan($id)->getRow();
        $model->deleteKecamatan($id);
        return redirect()->to(base_url("kecamatan"));
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
        $data['kecamatan']= $model->getKeyword($keyword);
        console_log($data);
        echo view('kecamatan_view', $data);
    }
}
