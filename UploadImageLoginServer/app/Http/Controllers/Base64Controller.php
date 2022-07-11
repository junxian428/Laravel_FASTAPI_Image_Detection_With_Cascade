<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Base64Controller extends Controller
{
    //
    public function addImage(Request $request) {
        $data = $request->json()->all();
        
    }
}
