<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }
    public function loginCheck()
    {
        $session = session();
        $users = $this->users;
        $email = $this->request->getPost('email');
        if (isset($users[$email])) {
            $password = $users[$email];
            if (password_verify($this->request->getPost('password'), $password)) {
                $session->set(['username'  => $email]);
                $session->regenerate();
                return redirect()->to('/admin/redirect');
            }
        }
        return redirect()->back()->with('error', 'incorrect uername or password!');
    }
}
