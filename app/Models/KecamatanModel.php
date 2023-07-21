<?php

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table = 'kecamatan';

    public function getKecamatan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_kecamatan' => $id]);
        }
    }

    public function getPolygon($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_kecamatan' => $id]);
        }
    }


    public function saveKecamatan($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateKecamatan($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_kecamatan' => $id));
        return $query;
    }

    public function deleteKecamatan($id)
    {
        $query = $this->db->table($this->table)->delete(array('id_kecamatan' => $id));
        return $query;
    }
}
