<?php

namespace App\Models;

use CodeIgniter\Model;

class NadzirModel extends Model
{
    protected $table = 'nadzir';

    public function getNadzir($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['NadzirWakaf' => $id]);
        }
    }

    public function getPolygon($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['NadzirWakaf' => $id]);
        }
    }


    public function saveNadzir($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateNadzir($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('NadzirWakaf' => $id));
        return $query;
    }

    public function deleteNadzir($id)
    {
        $query = $this->db->table($this->table)->delete(array('NadzirWakaf' => $id));
        return $query;
    }
}
