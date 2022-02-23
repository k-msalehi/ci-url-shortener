<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\GroceryCrud;
use App\Models\RedirectModel;

class Redirect extends BaseController
{
    public function index()
    {
        $crud = new GroceryCrud();
        $crud->setTable('redirects');
        //$crud->columns(['from', 'to',]);        
        $crud->setActionButton('Stats', 'fa-solid fa-signal', function ($row) {
            return "redirect/stats/{$row}";
        }, false);
        $crud->setActionButton('Visit', 'fa-solid fa-eye', function ($row) {
            $redirect = model(RedirectModel::class);
            $redirect = $redirect->where('id', $row)->first();
            return '/'. $redirect['from'];
        }, true);
        //$crud->unsetDelete();
        // $crud->setTheme('datatables');

        $crud->requiredFields(['from', 'to']);
        $crud->uniqueFields(['from']);
        $crud->setRule('to', 'To', 'valid_url');
        $output = $crud->render();

        //  return $this->_exampleOutput($output);
        return view('admin/redirect/index', (array)$output);
    }

}
