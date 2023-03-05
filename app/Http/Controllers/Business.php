<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Business extends Controller
{
    public function create() {
        return view('site.business-register');
    }

    public function store(Request $request) {
         dd($request);
    }
}
