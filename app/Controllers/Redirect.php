<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RedirectModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Redirect extends BaseController
{
    public function index()
    {
        dd('stop');
        return redirect()->to(MAIN_URL);
    }
    public function redirect($from = '')
    {
        $redirect = model(RedirectModel::class);
        $redirect = $redirect->where('from', $from)->findAll(1);
        if ($redirect)
            return redirect()->to($redirect[0]['to']);
        throw PageNotFoundException::forPageNotFound('URL not exist.');
    }
}
