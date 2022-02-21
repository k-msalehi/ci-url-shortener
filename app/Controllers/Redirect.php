<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RedirectModel;

class Redirect extends BaseController
{
    public function index($from='')
    {
        $redirect = model(RedirectModel::class);
        $redirect = $redirect->where('from',$from)->findAll(1);
        return redirect()->to($redirect[0]['to']);
    }
}
