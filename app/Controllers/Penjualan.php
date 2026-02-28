<?php

namespace App\Controllers;

use App\Models\PenjualanModel;
use App\Models\BarangModel;
use App\Models\PelangganModel;

class Penjualan extends BaseController
{
    public function index()
    {
        $penjualanModel = new PenjualanModel();
        
        // JOIN dengan tabel lain biar dapet nama_barang, nama_pelanggan
        $db = \Config\Database::connect();
        $builder = $db->table('tb_penjualan');
        $builder->select('tb_penjualan.*, tb_barang.nama_barang, tb_pelanggan.nama_pelanggan');
        $builder->join('tb_barang', 'tb_barang.id = tb_penjualan.id_barang', 'left');
        $builder->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_penjualan.id_pelanggan', 'left');
        $builder->orderBy('tb_penjualan.tanggal', 'DESC');
        
        $query = $builder->get();
        $data['penjualan'] = $query->getResultArray();
        
        return view('penjualan/index', $data);
    }

        public function delete($id)
    {
        $model = new \App\Models\PenjualanModel();
        $model->delete($id);

        return redirect()->to('/penjualan');
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        
        $penjualanModel = new PenjualanModel();
        $penjualanModel->update($id, ['status' => $status]);
        
        return $this->response->setJSON(['success' => true]);
    }
}