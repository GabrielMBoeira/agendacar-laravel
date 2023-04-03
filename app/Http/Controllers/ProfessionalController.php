<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProfessionalFormRequest;
use App\Models\Agenda;
use App\Models\Professional;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

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

        // $this->insertDatesInAgenda($professional->id, $professional->user_id, $request->date_start, $request->date_end, $request->interval);

        return redirect()->route('admin.professionals.create')->with('msg', 'Profissional cadastrado com sucesso!');
    }

    public function edit($id)
    {

        $professional = Professional::findOrFail($id);

        return view('admin.professionals_edit', compact('professional'));
    }

    public function update(StoreUpdateProfessionalFormRequest $request)
    {

        $professional = Professional::findOrFail($request->id);

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

        Professional::findOrFail($id)->delete();

        return redirect()->route('admin.professionals.index')->with('msg', 'Profissional deletado com sucesso!');
    }

    function insertDatesInAgenda($professional_id, $user_id, $date_start, $date_end, $interval)
    {

        // $date_start_obj = new DateTime($date_start);
        // $date_end_obj = new DateTime($date_end);
        // $diff = $date_start_obj->diff($date_end_obj);
        // $qtdDays = $diff->days;



        // // var_dump($interval);
        // // echo '<br>';
        // // var_dump(substr($interval, 3, 4));
        // // die;

        // //Loop Days
        // for ($i = 0; $i <= $qtdDays; $i++) {
        //     $data_agenda = $date_start_obj->format('Y-m-d');

        //     $horarios = array();
        //     $inicio = strtotime('08:00');
        //     $fim = strtotime('18:00');

        //     // Loop Intervals
        //     for ($j = 0; $inicio <= $fim; $j++) {

        //         if (substr($interval, 0, 2) == '00') {

        //             //Minuto
        //             $horarios[] = date('H:i', $inicio);
        //             $inicio = strtotime('+'.substr($interval, 3, 4).' minutes', $inicio);

        //             // dd($professional_id);

        //             // $agenda = new Agenda();

        //             // $agenda->$professional_id = $professional_id;
        //             // $agenda->$user_id = $user_id;
        //             // $agenda->date = $data_agenda;
        //             // $agenda->hour = $horarios[$j];
        //             // $agenda->save();

        //             // echo '<br>';
        //             // var_dump($data_agenda);
        //             // echo '<br>';

        //             // echo '<br>';
        //             // var_dump($horarios[$j]);
        //             // echo '<br>';
        //         } else {

        //             //Hora
        //             $horarios[] = date('H:i', $inicio);
        //             $inicio = strtotime('+1 hour', $inicio);

        //             $agenda = new Agenda();


        //             // $agenda->$professional_id = 'professional_id';
        //             // $agenda->$user_id = 'user_id';
        //             // $agenda->date = $data_agenda;
        //             // $agenda->hour = $horarios[$j];
        //             // $agenda->save();

        //             // echo '<br>';
        //             // var_dump($data_agenda);
        //             // echo '<br>';

        //             // echo '<br>';
        //             // var_dump($horarios[$j]);
        //             // echo '<br>';
        //         }



        //     }


        //     $date_start_obj->modify('+1 day');
        // }

    }
}
