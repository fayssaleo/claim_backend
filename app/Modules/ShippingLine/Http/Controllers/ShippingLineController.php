<?php

namespace App\Modules\ShippingLine\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingLineController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("ShippingLine::welcome");
    }
}
