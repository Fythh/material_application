<?php

namespace App\Controllers;

use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    public function index()
    {
        $model = new PelangganModel();
        $data['pelanggan'] = $model->findAll();

        return view('pelanggan/index', $data);
    }

    public function create()
    {
        return view('pelanggan/create');
    }

    public function store()
    {
        $model = new PelangganModel();

        $model->save([
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat' => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/pelanggan');
    }

    public function edit($id)
    {
        $model = new PelangganModel();
        $data['pelanggan'] = $model->find($id);

        return view('pelanggan/edit', $data);
    }

    public function update($id)
    {
        $model = new PelangganModel();

        $model->update($id, [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat' => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/pelanggan');
    }

    public function delete($id)
    {
        $model = new PelangganModel();
        $model->delete($id);

        return redirect()->to('/pelanggan');
    }
}