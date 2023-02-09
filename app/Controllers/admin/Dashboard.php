<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['session'] = session()->get();
        return view('admin/dashboard/index',$data);
    }
}
