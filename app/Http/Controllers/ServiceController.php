<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateServiceFormRequest;
use App\Models\Professional;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{


    public function index($professional_id)
    {

        $user = auth()->user();
        $services = Service::where('professional_id', $professional_id)->where('user_id', $user->id)->get();
        $professional = Professional::where('user_id', $user->id)->findOrFail($professional_id);

        return view('admin.services.services_index', compact('services', 'professional'));
    }

    public function create()
    {

        $user = auth()->user();
        $professionals = $user->professionals;

        return view('admin.services.services_create', compact('professionals'));
    }

    public function store(StoreUpdateServiceFormRequest $request)
    {

        $user = auth()->user();
        $model = new Service();
        $model->user_id = $user->id;
        $model->professional_id = $request->professional_id;
        $model->service = strtoupper($request->service);
        $model->time_service = $request->time_service;
        $model->save();

        return redirect()->route('admin.services.index', $request->professional_id)->with('msg', 'Serviço cadastrado com sucesso!');
    }

    public function edit($service_id)
    {
        $user = auth()->user();
        $service = Service::where('user_id', $user->id)->findOrFail($service_id);
        $professionals = $user->professionals;

        return view('admin.services.services_edit', compact('service', 'professionals'));
    }

    public function update(StoreUpdateServiceFormRequest $request)
    {

        $user = auth()->user();
        $model = Service::where('user_id', $user->id)->findOrFail($request->id);
        $model->service = mb_strtoupper($request->service, 'UTF-8');
        $model->time_service = $request->time_service;
        $model->save();

        return redirect()->route('admin.services.index', $request->professional_id)->with('msg', 'Serviço alterado com sucesso!');
    }

    public function destroy($service_id)
    {

        try {

            $user = auth()->user();
            $service = Service::where('user_id', $user->id)->findOrFail($service_id);
            $professional = $service->professional;
            $service->delete();

        } catch (\Illuminate\Database\QueryException $ex) {

            $errorCode = $ex->errorInfo[1];

            if ($errorCode == 1451) {
                return redirect()->route('admin.services.index')->with('msg', 'Não é possível excluir este serviço pois ele tem agendamentos associados.');
            }
        }

        return redirect()->route('admin.services.index', $professional->id)->with('msg', 'Serviço deletado com sucesso!');
    }
}
