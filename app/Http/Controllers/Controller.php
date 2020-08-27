<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
public $MAC ;

public function __construct()
{
    $this->MAC = exec('getmac');
    $this->MAC = strtok($this->MAC, ' ');
    if(!$this->MAC == '28-6C-07-94-95-6C'){
       exit;
    }
}
    
    
}
