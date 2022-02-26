<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RedirectModel;
use App\Models\VisitModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class RedirectController extends BaseController
{
    public function index()
    {
        return redirect()->to(MAIN_URL);
    }
    public function redirect($from = '')
    {
        $redirect = model(RedirectModel::class);
        $redirect = $redirect->where('from', $from)->first();
        if ($redirect) {
            $this->newVisit($redirect['from']);
            return redirect()->to($redirect['to']);
        }
        throw PageNotFoundException::forPageNotFound('URL not exist.');
    }

    private function newVisit($from)
    {
        helper('cookie');
        $agent = $this->request->getUserAgent();

        $browser = $agent->getBrowser() . ' ' . $agent->getVersion();
        $device = 'desktop';
        if ($agent->isRobot()) {
            $browser = $agent->getRobot();
            $device = 'bot';
        }
        if ($agent->isMobile()) {
            $device = 'mobile';
        }
        $os = $agent->getPlatform();
        $referrer  = $agent->getReferrer();

        $visit = model(VisitModel::class);
        $redirect = model(RedirectModel::class);

        $redirect = $redirect->where('from', $from)->first();
        $uid = uniqid('', true);

        //check if user already visited this link
        if (get_cookie('user_id')) {
            $uid = get_cookie('user_id');
        } else {
            setcookie('user_id', $uid, time() + (86400 * 365));
        }
        if (!get_cookie($from)) {
            setcookie($from, 'yes', time() + (86400 * 365));
        }
        //dd($uid);
        $data = [
            'redirect_id' => $redirect['id'],
            'user_id' => $uid,
            'referrer' => $referrer,
            'os' => $os,
            'browser' => $browser,
            'device' => $device,
        ];
        $visit->insert($data);
    }
}
