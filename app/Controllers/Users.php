<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        $model = new UsersModel();

        $data['users'] = $model->findAll();

        return view('users_view', $data);
    }
}
