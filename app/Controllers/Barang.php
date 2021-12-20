<?php

namespace App\Controllers;

use App\Models\BarangModel;
use CodeIgniter\RESTful\ResourceController;

class Barang extends ResourceController
{
    protected $format   = 'json';
    protected $BarangModel;
    public function __construct()
    {
        $this->BarangModel = new BarangModel();
    }
    public function index()
    {
        $getBarang = $this->BarangModel->getBarang();

        foreach ($getBarang as $getBarang) {
            $barang[] = [
                'idbarang' => intval($getBarang['idbarang']),
                'nama' => $getBarang['nama'],
                'idkategori' => intval($getBarang['idkategori']),
                'keterangan' => $getBarang['keterangan'],
                'file_gambar' => $getBarang['file_gambar'],
                'tampil' => $getBarang['tampil'],
                'harga' => intval($getBarang['harga']),
                'berat' => intval($getBarang['berat']),
                'stok' => intval($getBarang['stok']),
                'tgl_insert' => $getBarang['tgl_insert'],
                'tgl_update' => $getBarang['tgl_update'],
            ];
        }
        return $this->respond($barang, 200);
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        
        $nama = $this->request->getPost('nama');
        $idkategori = $this->request->getPost('idkategori');
        $keterangan = $this->request->getPost('keterangan');
        $file_gambar = $this->request->getPost('file_gambar');
        $harga = $this->request->getPost('harga');
        $berat = $this->request->getPost('berat');
        $stok = $this->request->getPost('stok');
        $tgl_insert = date("Y-m-d h:i:sa");
        $tgl_update = date("Y-m-d h:i:sa");
        
        $tampil = $this->request->getPost('tampil');
        if($tampil == null){
            $tampil = "tampil";
        }
        $barang = [
            'nama'      => $nama,
            'idkategori'   =>    $idkategori,
            'keterangan' => $keterangan,
            'file_gambar' => $file_gambar,
            'tampil' => $tampil,
            'harga' => $harga,
            'berat'  => $berat,
            'stok' => $stok,
            'tgl_insert' => $tgl_insert,
            'tgl_update'  => $tgl_update
        ];
        $saveBarang = $this->BarangModel->insertBarang($barang);

        if ($saveBarang == true) {
            $output = [
                'status' => 200,
                'message' => 'Data Berhasil Disimpan',
                'data' => ''
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 400,
                'message' => 'Data Gagal Disimpan',
                'data' => ''
            ];
            return $this->respond($output, 400);
        }
    }

    public function show($id = null)
    {
        $barang = $this->BarangModel->getBarang($id);
        if (!empty($barang)) {
            $output = [
                'idbarang' => intval($barang['idbarang']),
                'nama' => $barang['nama'],
                'idkategori' => intval($barang['idkategori']),
                'keterangan' => $barang['keterangan'],
                'file_gambar' => $barang['file_gambar'],
                'tampil' => $barang['tampil'],
                'harga' => intval($barang['harga']),
                'berat' => intval($barang['berat']),
                'stok' => intval($barang['stok']),
                'tgl_insert' => $barang['tgl_insert'],
                'tgl_update' => $barang['tgl_update'],
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 400,
                'message' => 'Data Tidak Ditemukan',
                'data' => ''
            ];
            return $this->respond($output, 400);
        }
    }
    public function edit($id = null)
    {
        $barang = $this->BarangModel->getBarang($id);
        if (!empty($barang)) {
            $output = [
                'idbarang' => intval($barang['idbarang']),
                'nama' => $barang['nama'],
                'idkategori' => intval($barang['idkategori']),
                'keterangan' => $barang['keterangan'],
                'file_gambar' => $barang['file_gambar'],
                'tampil' => $barang['tampil'],
                'harga' => intval($barang['harga']),
                'berat' => intval($barang['berat']),
                'stok' => intval($barang['stok']),
                'tgl_insert' => $barang['tgl_insert'],
                'tgl_update' => $barang['tgl_update'],
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 400,
                'message' => 'Data Tidak Ditemukan',
                'data' => ''
            ];
            return $this->respond($output, 400);
        }
    }

    public function update($id = null)
    {
        //menangkap data dari method PUT, DELETE, PATCH
        $data = $this->request->getRawInput();
        //cek data barang berdasarkan id
        $barang = $this->BarangModel->getBarang($id);
        //cek barang
        if (!empty($barang)) {
            //update
            $updateBarang = $this->BarangModel->updateBarang($data, $id);

            $output = [
                'status' => 200,
                'message' => 'Data Berhasil Di Update',
                'data' => ''
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 400,
                'message' => 'Data Gagal di Update',
                'data' => ''
            ];
            return $this->respond($output, 400);
        }
    }

    public function delete($id = null)
    {
        //menangkap data dari method PUT, DELETE, PATCH
        $data = $this->request->getRawInput();
        //cek data barang berdasarkan id
        $barang = $this->BarangModel->getBarang($id);
        //cek barang
        if (!empty($barang)) {
            //update
            $deleteBarang = $this->BarangModel->deleteBarang($id);

            $output = [
                'status' => 200,
                'message' => 'Data Berhasil di Hapus',
                'data' => ''
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 400,
                'message' => 'Data Gagal di Hapus',
                'data' => ''
            ];
            return $this->respond($output, 400);
        }
    }
}