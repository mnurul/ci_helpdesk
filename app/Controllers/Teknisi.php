<?php

namespace App\Controllers;

class Teknisi extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home Teknisi'
        ];
        return view('teknisi/index', $data);
    }

    //--------------------------------------------------------------------

}
