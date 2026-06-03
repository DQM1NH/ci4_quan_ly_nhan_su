<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (!$arguments || count($arguments) === 0) {
            return;
        }

        $permission = $arguments[0];

        $permissions = session()->get('permissions');

        if (!in_array($permission, $permissions)) {

            return redirect()->to('/dashboard')
                ->with('error', 'Bạn không có quyền truy cập');
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
    }
}