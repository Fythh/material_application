<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function process()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $login_role = $this->request->getPost('login_role'); 

        $user = $model->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Username tidak ditemukan!');
        }

        if ($user['password'] != $password) {
            return redirect()->back()->with('error', 'Password salah!');
        }

        if ($user['status_user'] != 'active') {
            return redirect()->back()->with('error', 'Akun Anda tidak aktif!');
        }

        if ($login_role !== $user['role']) {
            $pintu = ($login_role === 'admin') ? 'Staff/Seller' : 'Mitra';
            return redirect()->back()->with('error', "Ops! Akun Anda terdaftar sebagai " . $user['role'] . ", bukan $pintu.");
        }

        session()->set([
            'id_users'  => $user['id_users'], 
            'username'  => $user['username'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);

        if ($user['role'] == 'admin') {
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/user');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}