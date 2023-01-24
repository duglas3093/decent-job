<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['session'] = session()->get();
        return view('welcome_message');
    }
}
