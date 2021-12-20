<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table      = 'barang';
    protected $primaryKey = 'idbarang';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['idbarang', 'nama', 'idkategori', 'keterangan', 'file_gambar', 'tampil', 'harga', 'berat', 'stok', 'tgl_insert', 'tgl_update'];

    public function getBarang($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->getWhere(['idbarang' => $id])->getRowArray();
        }
        //var_dump($this->getWhere('idbarang', $id)->getRowArray());
    }

    public function insertBarang($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBarang($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idbarang' => $id]);
    }

    public function deleteBarang($id)
    {
        return $this->db->table($this->table)->delete(['idbarang' => $id]);
    }
}