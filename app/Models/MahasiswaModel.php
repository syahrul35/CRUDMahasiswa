<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';

    public function getMahasiswa()
    {
        return $this->findAll();
    }
    public function SimpanMahasiswa($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function PilihMahasiswa($id)
    {
        $query = $this->getWhere(['id_mahasiswa' => $id]);
        return $query;
    }
    public function editData($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id_mahasiswa' => $id));
        return $query;
    }
    public function HapusMahasiswa($id)
    {
        $query = $this->db->table($this->table)->delete(array('id_mahasiswa' => $id));
        return $query;
    }
}
