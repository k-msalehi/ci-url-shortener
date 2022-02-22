<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\GroceryCrud;

class Redirect extends BaseController
{
    public function index()
    {
        $crud = new GroceryCrud();
        $crud->setTable('redirects');

        $output = $crud->render();
        return view('admin.redirect.index');
        return $this->_exampleOutput($output);
    }
}
