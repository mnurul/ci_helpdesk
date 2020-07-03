<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home Admin'
        ];
        return view('admin/index', $data);
    }

    public function my_request()
    {
        $data = [
            'title' => 'My Request'
        ];
        return view('my_request/index', $data);
    }

    public function my_assigment_a()
    {
        $data = [
            'title' => 'My Assigment'
        ];
        return view('my_assigment_a/index', $data);
    }

    public function form_assigment_a()
    {
        $data = [
            'title' => 'Form My Assigment'
        ];
        return view('form_assigment_a/index', $data);
    }

    public function my_resolution()
    {
        $data = [
            'title' => 'My Resolution'
        ];
        return view('my_resolution/index', $data);
    }

    public function w_for_close()
    {
        $data = [
            'title' => 'Waiting for Close'
        ];
        return view('w_for_close/index', $data);
    }

    public function v_all_ticket_a()
    {
        $data = [
            'title' => 'View All Ticket'
        ];
        return view('v_all_ticket_a/index', $data);
    }

    public function popular_solution()
    {
        $data = [
            'title' => 'Popular Solution'
        ];
        return view('popular_solution/index', $data);
    }

    public function pivot_table_a()
    {
        $data = [
            'title' => 'Pivot Table'
        ];
        return view('pivot_table_a/index', $data);
    }

    public function sla_chart_a()
    {
        $data = [
            'title' => 'SLA Chart'
        ];
        return view('sla_chart_a/index', $data);
    }

    public function add_sla()
    {
        $data = [
            'title' => 'Add New SLA'
        ];
        return view('add_sla/index', $data);
    }

    public function sla_setting_a()
    {
        $data = [
            'title' => 'SLA Setting'
        ];
        return view('sla_setting_a/index', $data);
    }

    public function detail_sla()
    {
        $data = [
            'title' => 'Detail SLA'
        ];
        return view('detail_sla/index', $data);
    }

    public function create_user()
    {
        $data = [
            'title' => 'Create User'
        ];
        return view('create_user/index', $data);
    }

    public function list_user()
    {
        $data = [
            'title' => 'List User'
        ];
        return view('list_user/index', $data);
    }

    public function detail_user()
    {
        $data = [
            'title' => 'Detail User'
        ];
        return view('detail_user/index', $data);
    }

    public function create_project()
    {
        $data = [
            'title' => 'Create Project'
        ];
        return view('create_project/index', $data);
    }

    public function change_status()
    {
        $data = [
            'title' => 'Change Status Ticket'
        ];
        return view('change_status/index', $data);
    }

    public function form_status_ticket()
    {
        $data = [
            'title' => 'Form Change Status Ticket'
        ];
        return view('form_status_ticket/index', $data);
    }

    //--------------------------------------------------------------------

}
