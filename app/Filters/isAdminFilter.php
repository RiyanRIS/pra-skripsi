<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class isAdminFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (session()->user_role != 'admin') {
      return redirect()->to(base_url('/home/dashboard'))->with('msg', [0,'Akses dilarang.']);
    }
  }

  //--------------------------------------------------------------------
  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
