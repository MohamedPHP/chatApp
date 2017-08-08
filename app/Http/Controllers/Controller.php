<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Pusher;
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function trigger_pusher($channel, $event, $content) {
        $app_id = env('PUSHER_APP_ID');
        $app_key = env('PUSHER_APP_KEY');
        $app_secret = env('PUSHER_APP_SECRET');
        $app_cluster = env('PUSHER_APP_CLUSTER');
        $pusher = new Pusher\Pusher($app_key, $app_secret, $app_id, array('cluster' => $app_cluster));
        $pusher->trigger($channel, $event, $content);
    }

}
