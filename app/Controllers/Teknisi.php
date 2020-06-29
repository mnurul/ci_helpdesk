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

    public function my_assigment()
    {
        $data = [
            'title' => 'My Assigment'
        ];
        return view('my_assigment/index', $data);
    }

    public function v_all_ticket()
    {
        $data = [
            'title' => 'View All Ticket'
        ];
        return view('v_all_ticket/index', $data);
    }

    //--------------------------------------------------------------------

}
