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

    public function v_all_ticket_m()
    {
        $data = [
            'title' => 'View All Ticket'
        ];
        return view('v_all_ticket_m/index', $data);
    }

    public function pivot_table()
    {
        $data = [
            'title' => 'Pivot Table'
        ];
        return view('pivot_table/index', $data);
    }
    public function sla_chart()
    {
        $data = [
            'title' => 'SLA Chart'
        ];
        return view('sla_chart/index', $data);
    }

    //--------------------------------------------------------------------

}
