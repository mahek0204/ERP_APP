<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
//  suse App\Http\Controllers\HasMiddleware;

class Controller extends BaseController 
{
    use AuthorizesRequests, ValidatesRequests;
    

}
