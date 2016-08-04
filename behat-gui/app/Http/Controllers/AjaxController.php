<?php

namespace App\Http\Controllers;

use App\Notifications;
use Illuminate\Http\Request;

use App\Http\Requests;

class AjaxController extends Controller
{
    public function notification(){
        $notifications = Notifications::all();
        $return = [];
        if(!empty($notifications)) {
            foreach ($notifications as $n) {
                $return[$n->id] = $n->message;
                //$n->delete();
            }
            echo json_encode($return);
        }

    }

    public function kill_notification($id){
        $notifications = Notifications::where('id', '=', $id)->first();
        $notifications->delete();
    }
}
