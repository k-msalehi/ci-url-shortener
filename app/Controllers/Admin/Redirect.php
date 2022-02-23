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
        //$crud->columns(['from', 'to',]);        
        $crud->setActionButton('stats', 'fa-solid fa-signal', function ($row) {
            return "admin/redirect/stats/{$row}";
        }, false);
        //$crud->unsetDelete();
        // $crud->setTheme('datatables');

        $crud->requiredFields(['from', 'to']);
        $crud->uniqueFields(['from']);
        $crud->setRule('to', 'To', 'valid_url');
        $output = $crud->render();

        //  return $this->_exampleOutput($output);
        return view('admin/redirect/index', (array)$output);
    }

    private function _exampleOutput($output = null)
    {
        return view('example', (array)$output);
    }
}
