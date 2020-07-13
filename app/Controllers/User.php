<?php

namespace App\Controllers;

class User extends BaseController
{
    // public function index()
    // {
    //     $data = [
    //         'title' => 'Home User'
    //     ];
    //     return view('user/index', $data);
    // }

    public function index()
    {
        $data = [
            'title' => 'View Ticket Status'
        ];
        return view('v_ticket_status/index', $data);
    }

    public function create_ticket()
    {
        $data = [
            'title' => 'Create Ticket'
        ];
        return view('create_ticket/index', $data);
    }

    public function change_password()
    {
        $data = [
            'title' => 'Change Password'
        ];
        return view('change_password/index', $data);
    }

    public function v_ticket_status()
    {
        $data = [
            'title' => 'View Ticket Status'
        ];
        return view('v_ticket_status/index', $data);
    }

    //--------------------------------------------------------------------

}
