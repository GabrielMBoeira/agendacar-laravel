<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateBusinessFormRequest;
use App\Models\Business as ModelsBusiness;

class Business extends Controller
{
    public function create()
    {
        return view('site.business-register');
    }

    public function store(StoreUpdateBusinessFormRequest $request)
    {

        $business = new ModelsBusiness();

        $business->name = $request->name;
        $business->email = $request->email;
        $business->phone = $request->phone;
        $business->business = $request->business;
        $business->password = bcrypt($request->password);
        $business->status = 'active';

        $business->save();

        return redirect()->route('business.create')->with('msg', 'Estabelecimento cadastrado com sucesso!');
    }
}
