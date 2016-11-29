<?php

namespace App\Http\Controllers;

use App\Notifications;
use Illuminate\Http\Request;

use App\Http\Requests;

class AjaxController extends Controller
{
    /**
    * Create notification.
    *
    * @return void
    */
    public function notification(){
        $notifications = Notifications::all();
        $return = [];
        if(!empty($notifications)) {
            foreach ($notifications as $n) {
                $return[$n->id] = $n->message;
            }
            echo json_encode($return);
        }

    }

    /**
    * Delete notification.
    *
    * @param  int  $id
    * @return void
    */
    public function kill_notification($id){
        $notifications = Notifications::where('id', '=', $id)->first();
        $notifications->delete();
    }
}
