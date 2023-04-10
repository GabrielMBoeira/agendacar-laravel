<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProfessionalFormRequest;
use App\Models\Agenda;
use App\Models\Professional;
use App\Models\Service;
use DateTime;

class ProfessionalController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $professionals = Professional::where('user_id', $user->id)->with('services')->get();

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

        $services = [
            strtoupper($request->service1) => $request->time_service1,
            strtoupper($request->service2) => $request->time_service2,
            strtoupper($request->service3) => $request->time_service3,
            strtoupper($request->service4) => $request->time_service4,
            strtoupper($request->service5) => $request->time_service5,
        ];

        $professional = new Professional();
        $professional->name = strtoupper($request->name);
        $professional->date_start = $request->date_start;
        $professional->date_end = $request->date_end;
        $professional->interval = $request->interval;
        $professional->status = 'active';
        $professional->user_id = $user->id;
        $professional->save();

        //Recuperando o id do professional inserido.
        // $professional->id;

        $this->insertDatesInAgenda($user->id , $professional->id, $request->date_start, $request->date_end, $request->interval);
        $this->insertService($user->id, $professional->id, $services);

        return redirect()->route('admin.professionals.create')->with('msg', 'Profissional cadastrado com sucesso!');
    }

    public function edit($id)
    {

        $user = auth()->user();
        $professional = Professional::where('user_id', $user->user)->findOrFail($id);

        return view('admin.professionals_edit', compact('professional'));
    }

    public function update(StoreUpdateProfessionalFormRequest $request)
    {
        $user = auth()->user();
        $professional = Professional::where('user_id', $user->id)->findOrFail($request->id);

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

    public function destroy($id)
    {
        try {

            $user = auth()->user();
            Professional::where('user_id', $user->id)->findOrFail($id)->delete();

        } catch (\Illuminate\Database\QueryException $ex) {

            $errorCode = $ex->errorInfo[1];

            if ($errorCode == 1451) {
                return redirect()->route('admin.professionals.index')->with('msg', 'Não é possível excluir este profissional porque ele tem agendamentos associados.');
            }

        }

        return redirect()->route('admin.professionals.index')->with('msg', 'Profissional deletado com sucesso!');
    }

    function insertDatesInAgenda($user_id, $professional_id, $date_start, $date_end, $interval)
    {
        $date_start_obj = new DateTime($date_start);
        $date_end_obj = new DateTime($date_end);
        $diff = $date_start_obj->diff($date_end_obj);
        $qtdDays = $diff->days;

        //Loop Days
        for ($i = 0; $i <= $qtdDays; $i++) {

            $agenda_date = $date_start_obj->format('Y-m-d');
            $hours = array();
            $hour_initial = strtotime('08:00');
            $hour_final = strtotime('18:00');

            // Loop Intervals
            for ($j = 0; $hour_initial <= $hour_final; $j++) {

                $agenda = new Agenda();

                if (substr($interval, 0, 2) == '00') {

                    //Minuto
                    $hours[] = date('H:i', $hour_initial);
                    $hour_initial = strtotime('+'.substr($interval, 3, 4).' minutes', $hour_initial);

                    $agenda->user_id = $user_id;
                    $agenda->professional_id = $professional_id;
                    $agenda->date = $agenda_date;
                    $agenda->hour = $hours[$j];
                    $agenda->status = 'active';
                    $agenda->save();

                } else {

                    //Hora
                    $hours[] = date('H:i', $hour_initial);
                    $hour_initial = strtotime('+'.substr($interval, 0, 2).' hour', $hour_initial);

                    $agenda->user_id = $user_id;
                    $agenda->professional_id = $professional_id;
                    $agenda->date = $agenda_date;
                    $agenda->hour = $hours[$j];
                    $agenda->status = 'active';
                    $agenda->save();
                }

            }

            $date_start_obj->modify('+1 day');
        }
    }

    function insertService($user_id, $professional_id, $services)
    {
        foreach ($services as $service => $time_service) {

            if ($service && $time_service) {

                $modelService = new Service();
                $modelService->user_id = $user_id;
                $modelService->professional_id = $professional_id;
                $modelService->service = $service;
                $modelService->time_service = $time_service;
                $modelService->save();
            }

        }
    }

}
