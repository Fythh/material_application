<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;

class Barang extends BaseController
{
    public function index()
    {
        $model = new BarangModel();

        $data['barang'] = $model
            ->select('tb_barang.*, tb_kategori.nama_kategori')
            ->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori')
            ->findAll();

        return view('barang/index', $data);
    }

        public function create()
    {
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        return view('barang/create', $data);
    }

    public function store()
    {
        $model = new BarangModel();

        $model->save([
        'nama_barang' => $this->request->getPost('nama_barang'),
        'harga' => $this->request->getPost('harga'),
        'stok' => $this->request->getPost('stok'),
        'id_kategori' => $this->request->getPost('id_kategori')
    ]);
        return redirect()->to('/barang');
    }

    public function delete($id)
    {
        $model = new BarangModel();
        $model->delete($id);

        return redirect()->to('/barang');
    }

    public function edit($id)
    {
        $model = new BarangModel();
        $kategoriModel = new \App\Models\KategoriModel();

        $data['barang'] = $model->find($id);
        $data['kategori'] = $kategoriModel->findAll();

        return view('barang/edit', $data);
    }

    public function update($id)
    {
        $model = new BarangModel();

        $model->update($id, [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok'),
            'id_kategori' => $this->request->getPost('id_kategori')
        ]);

        return redirect()->to('/barang');
    }
}