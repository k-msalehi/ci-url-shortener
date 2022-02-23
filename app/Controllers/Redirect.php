<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RedirectModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Redirect extends BaseController
{
    public function index()
    {
        return redirect()->to(MAIN_URL);
    }
    public function redirect($from = '')
    {
        $redirect = model(RedirectModel::class);
        $redirect = $redirect->where('from', $from)->first();
        if ($redirect)
            return redirect()->to($redirect['to']);
        throw PageNotFoundException::forPageNotFound('URL not exist.');
    }
}
