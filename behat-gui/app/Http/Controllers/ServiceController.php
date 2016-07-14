<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ServiceController extends Controller
{
    protected $httpd;
    protected $mysqld;
    protected $selenium;
    protected $sshd;

    protected $services = ['httpd', 'mysqld', 'selenium', 'sshd'];

    public function __construct()
    {
        #check the status of each of the services
        foreach($this->services as $s){
            exec('service '. $s. ' status', $output);
            unset($output[0]);
            $this->$s = $output;
        }

    }

    public function index(){
        dd($this->httpd);
        return view('services.index');
    }

}
