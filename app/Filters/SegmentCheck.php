<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SegmentCheck implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        // Do something here
        // localhost/admin/my_assigment_a -> uri segment(2)

        $uri = service('uri');
        if ((session()->get('username') == '' && $uri->getSegment(1) == 'admin') || (session()->get('username') == '' && $uri->getSegment(1) == 'teknisi') || (session()->get('username') == '' && $uri->getSegment(1) == 'user') || (session()->get('username') == '' && $uri->getSegment(1) == 'manager')) {
            if ($uri->getSegment(2) == '')
                $segment = '/';
            else
                $segment = '/' . $uri->getSegment(2);

            // return redirect()->to($segment);
            session()->setFlashdata('salah', 'Kamu harus Login2');
            return redirect()->to(base_url('/'));
        }

        // if (session()->get('username') == '') {
        //     echo 'test';
        //     session()->setFlashdata('salah', 'Kamu harus Login');
        //     return redirect()->to(base_url('/'));
        // }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}
