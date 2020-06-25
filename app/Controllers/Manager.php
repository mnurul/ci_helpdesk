<?php

namespace App\Controllers;

class Manager extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home Manager'
        ];
        return view('manager/index', $data);
    }

    //--------------------------------------------------------------------

}
