<?php

namespace App\Models;

use CodeIgniter\Model;


class SearchModel extends Model
{
    public function get_keyword($keyword){
        $this->db->select('*');
        $this->db->from('tanah');
        $this->db->like('No',$keyword);
        $this->db->or_like('Lokasi',$keyword);
        $this->db->or_like('Tipe',$keyword);
        $this->db->or_like('LuasDahulu',$keyword);
        $this->db->or_like('LuasSekarang',$keyword);
        $this->db->or_like('LuasDalamBau',$keyword);
        $this->db->or_like('LuasDalamTumbak',$keyword);
        $this->db->or_like('LuasDalamMeterPersegi',$keyword);
        $this->db->or_like('KoordinatLokasi',$keyword);
        $this->db->or_like('NadzirWakaf',$keyword);
        $this->db->or_like('polygon',$keyword);
        $this->db->or_like('marker',$keyword);
        $this->db->or_like('googleearth',$keyword);
        return$this->db->get()->result();
    }
}
