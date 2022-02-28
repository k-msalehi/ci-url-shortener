<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\GroceryCrud;
use App\Models\RedirectModel;
use App\Models\VisitModel;

class RedirectController extends BaseController
{
    public function index()
    {
        $crud = new GroceryCrud();
        $crud->setTable('redirects');
        //$crud->columns(['from', 'to',]);        
        $crud->setActionButton('Stats', 'fa-solid fa-signal', function ($row) {
            return "/admin/redirect/stats/{$row}";
        }, false);
        $crud->setActionButton('Visit', 'fa-solid fa-eye', function ($row) {
            $redirect = model(RedirectModel::class);
            $redirect = $redirect->where('id', $row)->first();
            return '/' . $redirect['from'];
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

    public function stats($id)
    {
        $db = db_connect();
        $builder = $db->table('visits');
        $visits = model(VisitModel::class);
        $redirect = model(RedirectModel::class);
        $data['redirect'] = $redirect->find($id);
        $totalVisits = $visits->where('redirect_id', $id);
        $uVisits = $builder->select('`redirect_id`, `user_id`')->where('redirect_id', $id);

        if ($this->request->getGet('from')) {
            if ($this->checkDate($this->request->getGet('from'))) {
                $uVisits = $uVisits->where('created_at >=', $this->request->getGet('from'));
                $totalVisits = $visits->where('created_at >=', $this->request->getGet('from'));
            }
        }
        if ($this->request->getGet('to')) {
            if ($this->checkDate($this->request->getGet('from'))) {
                $uVisits = $uVisits->where('created_at <=', $this->request->getGet('to'));
                $totalVisits = $visits->where('created_at <=', $this->request->getGet('to'));
            }
        }
        $data['uVisits'] = $uVisits->distinct()->get()->getResult();
        $data['totalVisits'] =  $totalVisits->findAll();
        $data['browsers'] = [];
        $data['os'] = [];
        $data['device'] = [];
        foreach ($data['totalVisits']  as $visit) {
            $data['referrer'][] =$visit['referrer'];
            if (stripos($visit['device'], 'mobile') === 0) {
                $data['device']['mobile'][] = $visit['device'];
            } elseif (stripos($visit['device'], 'desktop') === 0) {
                $data['device']['desktop'][] =  $visit['device'];
            } elseif (stripos($visit['device'], 'bot') === 0) {
                $data['device']['bot'][] =  $visit['device'];
            }

            if (stripos($visit['os'], 'android') === 0) {
                $data['os']['android'][] = $visit['os'];
            } elseif (stripos($visit['os'], 'ios') === 0) {
                $data['os']['ios'][] =  $visit['os'];
            } elseif (stripos($visit['os'], 'windows') === 0) {
                $data['os']['windows'][] =  $visit['os'];
            } elseif (stripos($visit['os'], 'linux') === 0) {
                $data['os']['linux'][] =  $visit['os'];
            } elseif (stripos($visit['os'], 'gnu') === 0) {
                $data['os']['linux'][] =  $visit['os'];
            } else {
                $data['os']['other'][] =  $visit['os'];
            }

            if (stripos($visit['browser'], 'Firefox') === 0) {
                $data['browsers']['firefox'][] = $visit['browser'];
            } elseif (stripos($visit['browser'], 'Chrome') === 0) {
                $data['browsers']['chrome'][] =  $visit['browser'];
            } elseif (stripos($visit['browser'], 'Edge') === 0) {
                $data['browsers']['edge'][] =  $visit['browser'];
            } elseif (stripos($visit['browser'], 'Opera') === 0) {
                $data['browsers']['opera'][] =  $visit['browser'];
            } elseif (stripos($visit['browser'], 'bot') === 0) {
                $data['browsers']['opera'][] =  $visit['browser'];
            } else {
                $data['browsers']['other'][] =  $visit['browser'];
            }
        }
        sort($data['referrer']);
        $data['referrer'] = array_count_values($data['referrer']);
        $data['referrer']['No referrer'] = $data['referrer'][''];
        unset($data['referrer']['']);

        ksort($data['browsers']);
        ksort($data['os']);
        ksort($data['device']);
        return view('admin/redirect/stats', $data);
    }

    private function checkDate($date)
    {
        $tempDate = explode('-', $date);
        // checkdate(month, day, year)
        if (count($tempDate) != 3)
            return false;
        return checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
    }
}
