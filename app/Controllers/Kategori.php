<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function index()
    {
        $model = new KategoriModel();
        $data['kategori'] = $model->findAll();

        return view('kategori/index', $data);
    }

    public function create()
    {
        return view('kategori/create');
    }

    public function store()
    {
        $model = new KategoriModel();

        $model->save([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori');
    }

    public function edit($id)
    {
        $model = new KategoriModel();
        $data['kategori'] = $model->find($id);

        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        $model = new KategoriModel();

        $model->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $model = new KategoriModel();
        $model->delete($id);

        return redirect()->to('/kategori');
    }
}