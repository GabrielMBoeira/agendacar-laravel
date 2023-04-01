<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProfessionalFormRequest;
use App\Models\Professional;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class ProfessionalController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $professionals = Professional::all();

        return view('admin.professionals', compact('user', 'professionals'));
    }

    public function create()
    {

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
        $professional->name = strtoupper($request->name);
        $professional->date_start = $request->date_start;
        $professional->date_end = $request->date_end;
        $professional->interval = $request->interval;
        $professional->service1 = strtoupper($request->service1);
        $professional->time_service1 = $request->time_service1;
        $professional->service2 = strtoupper($request->service2);
        $professional->time_service2 = $request->time_service2;
        $professional->service3 = strtoupper($request->service3);
        $professional->time_service3 = $request->time_service3;
        $professional->service4 = strtoupper($request->service4);
        $professional->time_service4 = $request->time_service4;
        $professional->service5 = strtoupper($request->service5);
        $professional->time_service5 = $request->time_service5;
        $professional->status = 'active';
        $professional->user_id = $user->id;
        $professional->save();

        return redirect()->route('admin.professionals.create')->with('msg', 'Profissional cadastrado com sucesso!');
    }

    public function edit($id)
    {

        if (!$professional = Professional::findOrFail($id)) {
            return redirect()->route('admin.professionals');
        }

        return view('admin.professionals_edit', compact('professional'));
    }

    public function update(StoreUpdateProfessionalFormRequest $request)
    {

        if (!$professional = Professional::findOrFail($request->id)) {
            return redirect()->route('admin.professionals');
        }

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
            return redirect()->route('admin.professionals.edit', $professional)->with('service_null', 'Cadastre pelo menos 01 (um) serviço!');
        }

        $professional->name = strtoupper($request->name);
        $professional->date_start = $request->date_start;
        $professional->date_end = $request->date_end;
        $professional->interval = $request->interval;
        $professional->service1 = strtoupper($request->service1);
        $professional->time_service1 = $request->time_service1;
        $professional->service2 = strtoupper($request->service2);
        $professional->time_service2 = $request->time_service2;
        $professional->service3 = strtoupper($request->service3);
        $professional->time_service3 = $request->time_service3;
        $professional->service4 = strtoupper($request->service4);
        $professional->time_service4 = $request->time_service4;
        $professional->service5 = strtoupper($request->service5);
        $professional->time_service5 = $request->time_service5;
        $professional->save();

        return redirect()->route('admin.professionals.index')->with('msg', 'Profissional alterado com sucesso!');
    }

    public function destroy($id) {

        Professional::findOrFail($id)->delete();

        return redirect()->route('admin.professionals.index')->with('msg', 'Profissional deletado com sucesso!');

    }
}
