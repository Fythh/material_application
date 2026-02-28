<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;

class Barang extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tb_barang');
        $builder->select('tb_barang.*, tb_kategori.nama_kategori');
        $builder->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori');

        $query = $builder->get();

        $data['barang'] = $query->getResultArray();

        return view('barang/index', $data);
    }

    public function create()
    {
        $kategoriModel = new \App\Models\KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        return view('barang/create', $data);
    }

    public function store()
    {
        $file = $this->request->getFile('foto');
        $namaFoto = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFoto = $file->getRandomName();
            $file->move('uploads', $namaFoto);
        }

        $model = new \App\Models\BarangModel();

        $model->save([
            'nama_barang' => $this->request->getPost('nama_barang'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'foto'        => $namaFoto
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
        $model = new \App\Models\BarangModel();

        $barangLama = $model->find($id);

        $file = $this->request->getFile('foto');
        $namaFoto = $barangLama['foto']; // default pakai foto lama

        // Kalau upload foto baru
        if ($file && $file->isValid() && !$file->hasMoved()) {

            // Hapus foto lama kalau ada
            if (!empty($barangLama['foto']) && file_exists('uploads/' . $barangLama['foto'])) {
                unlink('uploads/' . $barangLama['foto']);
            }

            $namaFoto = $file->getRandomName();
            $file->move('uploads', $namaFoto);
        }

        $model->update($id, [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'foto'        => $namaFoto
        ]);

        return redirect()->to('/barang');
    }

    public function detail($id)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tb_barang');
        $builder->select('*');
        $builder->where('id', $id);

        $data['barang'] = $builder->get()->getRowArray();

        return view('barang/detail', $data);
    }
}