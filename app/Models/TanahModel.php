<?php

namespace App\Models;

use CodeIgniter\Model;

class TanahModel extends Model
{
    protected $table = 'tanah';

    public function getKeyword($keyword){
        helper('form');
        $this->select('*')
        ->like('Lokasi', $keyword);
        // $this->db->table($this->table)->from('tanah');
        // $this->db->table($this->table)->like('No',$keyword);
        // $this->db->table($this->table)->orLike('Lokasi',$keyword);
        // $this->db->table($this->table)->orLike('Tipe',$keyword);
        // $this->db->table($this->table)->orLike('LuasDahulu',$keyword);
        // $this->db->table($this->table)->orLike('LuasSekarang',$keyword);
        // $this->db->table($this->table)->orLike('LuasDalamBau',$keyword);
        // $this->db->table($this->table)->orLike('LuasDalamTumbak',$keyword);
        // $this->db->table($this->table)->orLike('LuasDalamMeterPersegi',$keyword);
        // $this->db->table($this->table)->orLike('KoordinatLokasi',$keyword);
        // $this->db->table($this->table)->orLike('NadzirWakaf',$keyword);
        // $this->db->table($this->table)->orLike('polygon',$keyword);
        // $this->db->table($this->table)->orLike('marker',$keyword);
        // $this->db->table($this->table)->orLike('googleearth',$keyword);
        return $this->findAll();
    }

    public function getTanah($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['No' => $id]);
        }
    }

    public function getPolygon($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['No' => $id]);
        }
    }


    public function saveTanah($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateTanah($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('No' => $id));
        return $query;
    }

    public function deleteTanah($id)
    {
        $query = $this->db->table($this->table)->delete(array('No' => $id));
        return $query;
    }
}
