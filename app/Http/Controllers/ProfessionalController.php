<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProfessionalFormRequest;
use App\Models\Professional;
use Symfony\Component\VarDumper\VarDumper;

class ProfessionalController extends Controller
{
    public function index() {

        $user = auth()->user();

        return view('admin.professionals', compact('user'));

    }

    public function create() {

        return view('admin.professionals_create');

    }

    public function store(StoreUpdateProfessionalFormRequest $request)
    {

        $user = auth()->user();

        $data = [
            $request->service1,
            $request->service2,
            $request->service3,
            $request->service4,
            $request->service5
        ];

        $count = 0;
        foreach ($data as $key) {
            if (isset($key)) {
                $count++;
            }
        }

        if ($count == 0) {
            return redirect()->route('admin.professionals.create')->with('service_null', 'Cadastre pelo menos 01 (um) serviço!');
        }


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

        return redirect()->route('admin.professionals.create')->with('msg', 'Profissional cadastrado com sucesso!');
    }

    public function edit($id) {

        if (!$professional = Professional::find($id)) {
            return redirect()->route('admin.professionals.index');
        }

        return view('admin.professionals_show', compact('professional'));

    }

}
