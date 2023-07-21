<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NadzirModel;

class Nadzir extends Controller
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
        $model = new NadzirModel();
        $data['nadzir'] = $model->getNadzir();
        console_log($data);
        echo view('nadzir_view', $data);
    }

    public function add_new()
    {
        echo view('add_nadzir');
    }

    public function save()
    {
        $model = new NadzirModel();
        $data = array(
            'NadzirWakaf'  => $this->request->getPost('NadzirWakaf'),
            'nama' => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'tupoksi' => $this->request->getPost('tupoksi'),
            'alamat' => $this->request->getPost('alamat'),
            'sk' => $this->request->getPost('sk'),
            'status' => $this->request->getPost('status'),
        );  
        $model->saveNadzir($data);
        return redirect()->to(base_url("nadzir"));
    }

    public function edit($id)
    {
        $model = new NadzirModel();
        $data['nadzir'] = $model->getNadzir($id)->getRow();
        echo view('edit_nadzir', $data);
    }

    public function update()
    {
        $model = new NadzirModel();
        $id = $this->request->getPost('NadzirWakaf');
        $data = array(
            'NadzirWakaf'  => $this->request->getPost('NadzirWakaf'),
            'nama' => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'tupoksi' => $this->request->getPost('tupoksi'),
            'alamat' => $this->request->getPost('alamat'),
            'sk' => $this->request->getPost('sk'),
            'status' => $this->request->getPost('status'),

        );
        $model->updateNadzir($data, $id);
        return redirect()->to(base_url("nadzir"));
    }

    public function delete($id)
    {
        $model = new NadzirModel();
        $data['nadzir'] = $model->getNadzir($id)->getRow();
        $model->deleteNadzir($id);
        return redirect()->to(base_url("nadzir"));
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
        $data['nadzir']= $model->getKeyword($keyword);
        console_log($data);
        echo view('nadzir_view', $data);
    }
}
