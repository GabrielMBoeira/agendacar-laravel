<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function store(Request $request) {

       $user = auth()->user();

       $professional = new Professional();
       $professional->name = $request->name;
       $professional->date_start = $request->date_start;
       $professional->date_end = $request->date_end;
       $professional->interval = $request->interval;
       $professional->service1 = $request->service1;
       $professional->time_service1 = $request->time_service1;
       $professional->service2 = $request->service2;
       $professional->time_service2 = $request->time_service2;
       $professional->service3 = $request->service3;
       $professional->time_service3 = $request->time_service3;
       $professional->service4 = $request->service4;
       $professional->time_service4 = $request->time_service4;
       $professional->service4 = $request->service4;
       $professional->time_service4 = $request->time_service4;
       $professional->status = 'active';
       $professional->user_id = $user->id;
       $professional->save();

        return redirect()->route('admin.register_professional')->with('msg', 'Profissional cadastrado com sucesso!');

    }
}
