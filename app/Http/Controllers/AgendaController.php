<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgendaDate;
use App\Http\Requests\StoreUpdateAgendaSingleFormRequest;
use App\Models\Agenda;
use App\Models\Professional;
use App\Models\Service;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index($professional_id)
    {
        $professional = Professional::findOrFail($professional_id);

        $agendas = Agenda::where('professional_id', $professional_id)
            ->groupBy('date')
            ->get();

        return view('admin.agenda.agendas', ['professional' => $professional, 'agendas' => $agendas]);
    }

    public function create()
    {

        $user = auth()->user();
        $professionals = $user->professionals;

        return view('admin.agenda.agendas_create', compact('professionals'));
    }

    public function store(StoreAgendaDate $request)
    {

        $professional_id = $request->professional_id;
        $date_start = $request->date_start;
        $date_end = $request->date_end;
        $interval = $request->interval;

        $date_start_obj = new DateTime($date_start);
        $date_end_obj = new DateTime($date_end);
        $diff = $date_start_obj->diff($date_end_obj);
        $qtdDays = $diff->days;

        $agendas = Agenda::where('date', '=', $date_start)
            ->where('professional_id', '=', $professional_id)
            ->get()
            ->first();

        $date = date('d/m/Y', strtotime($date_start));

        if ($agendas && $agendas->date == $date_start) {

            return redirect()->route('admin.agenda.index', compact('professional_id'))->with("msg", "Data informada ($date) já consta agendamento cadastrado!");
        }

        //Loop Days
        for ($i = 0; $i <= $qtdDays; $i++) {

            $agendas = Agenda::where('date', '=', $date_start_obj->format('Y-m-d'))
                ->where('professional_id', '=', $professional_id)
                ->get()
                ->first();

            if ($agendas) {

                $date = date('d/m/Y', strtotime($agendas->date));
                return redirect()->route('admin.agenda.index', compact('professional_id'))->with("msg", "Data informada ($date) já consta agenda cadastrada!");
            }

            $date_start_obj->modify('+1 day');
        }

        $this->insertDatesInAgenda($professional_id, $date_start, $date_end, $interval);

        return redirect()->route('admin.agenda.index', compact('professional_id'))->with('msg', 'Agenda cadastrada com sucesso!');
    }

    public function view($date, $professional_id)
    {

        $agendas = Agenda::select(['agendas.*', 'services.id as service_id', 'services.service as service'])
            ->leftJoin('services', 'services.id', '=', 'agendas.service')
            ->where('agendas.professional_id', '=', $professional_id)
            ->where('agendas.date', '=', $date)
            ->orderBy('date')
            ->orderBy('hour')
            ->get();

        $professional = Professional::findOrFail($professional_id);

        return view('admin.agenda.agenda_view', compact('agendas', 'professional'));
    }

    public function show($id_agenda)
    {

        $scheduling = Agenda::findOrFail($id_agenda);
        $professional = $scheduling->professional;

        $services = Service::where('professional_id', $professional->id)->get();

        return view('admin.agenda.agendas_show', compact('scheduling', 'professional', 'services'));
    }

    public function scheduling(Request $request)
    {

        $service = Service::findOrFail($request->service);
        $request_hour_dt = DateTime::createFromFormat('H:i:s', $request->scheduling_hour);
        $scheduling_hour_dt = DateTime::createFromFormat('H:i:s', $request->scheduling_hour);
        $hour = substr($service->time_service, 0, 2);
        $minute = substr($service->time_service, 3, 2);

        //Adicionando tempo do serviço ao agendamento solicitado
        $scheduling_add = $scheduling_hour_dt->add(new DateInterval('PT' . $hour . 'H' . $minute . 'M'));

        $schedulings = Agenda::where('professional_id',  $request->professional_id)
            ->where('date', $request->scheduling_date)->get();

        //Check conflito de horários
        foreach ($schedulings as $scheduling) {
            $date = $scheduling->date;
            $professional_id =  $scheduling->professional_id;

            if ($scheduling->hour >= $request->scheduling_hour) {

                $next_scheduling = DateTime::createFromFormat('H:i:s', $scheduling->hour);

                if ($scheduling_add > $next_scheduling) {
                    if (isset($scheduling->client)) {
                        return redirect()->route('admin.agenda.view', compact('date', 'professional_id'))->with('msg', 'Conflito de horário, tempo de serviço excede horário disponível!');
                    }
                }
            }
        }

        foreach ($schedulings as $scheduling) {
            $date = $scheduling->date;
            $professional_id =  $scheduling->professional_id;

            if ($scheduling->hour >= $request->scheduling_hour) {

                $next_scheduling = DateTime::createFromFormat('H:i:s', $scheduling->hour);

                if ($scheduling_add > $next_scheduling) {
                    if (isset($scheduling->client)) {
                        return redirect()->route('admin.agenda.view', compact('date', 'professional_id'))->with('msg', 'Conflito de horário, tempo de serviço excede horário disponível!');
                    } else {
                        $scheduling->client = $request->client;
                        $scheduling->email = $request->email;
                        $scheduling->service = $request->service;
                        $scheduling->updated_at = date('Y-m-d H:i:s', $request->server('REQUEST_TIME'));
                        $scheduling->save();
                    }
                }
            }
        }

        return redirect()->route('admin.agenda.view', compact('date', 'professional_id'))->with('msg', 'Agendamento cadastrado com sucesso!');
    }

    public function destroy($agenda_id)
    {

        try {

            $agenda = Agenda::findOrFail($agenda_id);
            $agenda->delete();
        } catch (\Illuminate\Database\QueryException $ex) {

            $errorCode = $ex->errorInfo[1];

            if ($errorCode == 1451) {
                return redirect()->route('admin.agenda.index', $agenda->professional_id)->with('msg', 'Não é possível excluir este agendamento.');
            }
        }

        return redirect()->route('admin.agenda.view', [$agenda->date, $agenda->professional_id]);
        // return redirect()->route('admin.agenda.view', [$agenda->date, $agenda->professional_id])->with('msg', 'Agenda deletada com sucesso!');
    }

    function insertDatesInAgenda($professional_id, $date_start, $date_end, $interval)
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
                    $hour_initial = strtotime('+' . substr($interval, 3, 4) . ' minutes', $hour_initial);

                    $agenda->professional_id = $professional_id;
                    $agenda->date = $agenda_date;
                    $agenda->hour = $hours[$j];
                    $agenda->status = 'active';
                    $agenda->save();
                } else {

                    //Hora
                    $hours[] = date('H:i', $hour_initial);
                    $hour_initial = strtotime('+' . substr($interval, 0, 2) . ' hour', $hour_initial);

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

    public function clean($agenda_id)
    {

        $scheduling = Agenda::findOrFail($agenda_id);
        $scheduling->client = null;
        $scheduling->email = null;
        $scheduling->service = null;
        $scheduling->save();

        $date = $scheduling->date;
        $professional_id =  $scheduling->professional_id;

        return redirect()->route('admin.agenda.view', compact('date', 'professional_id'))->with('msg', 'Agenda limpa com sucesso!');
    }

    public function destroyDate($date, $professional_id)
    {

        $schedulingDate = Agenda::where('date', '=', $date)->where('professional_id', '=', $professional_id)->get();

        foreach ($schedulingDate as $scheduling) {
            $scheduling->delete();
        }

        return redirect()->route('admin.agenda.index', compact('professional_id'));
        // return redirect()->route('admin.agenda.index', compact('professional_id'))->with('msg', 'Data deletada com sucesso!');
    }

    public function createSingle()
    {

        $user = auth()->user();
        $professionals = $user->professionals;

        return view('admin.agenda.agendas_create_single', compact('professionals'));
    }

    public function storeSingle(StoreUpdateAgendaSingleFormRequest $request)
    {
        $agendas = Agenda::where('date', '=', $request->date)
            ->where('professional_id', '=', $request->professional_id)
            ->orderBy('date')
            ->orderBy('hour')
            ->get();

        $date = date('d/m/Y', strtotime($request->date));
        $hour = date('H:i:s', strtotime($request->hour));

        foreach ($agendas as $agenda) {

            if ($agenda->date == $request->date && $agenda->hour == $hour) {
                return redirect()->route('admin.agenda.index', $request->professional_id)
                    ->with('msg', "Já existe agenda criada com esta data e horário ($date - $request->hour h)! Cadastre uma agenda específica ou delete agendamento deste dia para criar lote e intervalos novamente!");
            }
        }

        $model = new Agenda();
        $model->professional_id = $request->professional_id;
        $model->date = $request->date;
        $model->hour = $request->hour;
        $model->status = 'active';
        $model->save();

        return redirect()->route('admin.agenda.index', $request->professional_id)->with('msg', "Agenda do dia ($date - $request->hour h) foi cadastrada com sucesso.");
    }

    function checkExistDate($professional_id, $date_start, $date_end)
    {
        // $date_start_obj = new DateTime($date_start);
        // $date_end_obj = new DateTime($date_end);
        // $diff = $date_start_obj->diff($date_end_obj);
        // $qtdDays = $diff->days;

        // $agendas = Agenda::where('date', '=', $date_start)
        //     ->where('professional_id', '=', $professional_id)
        //     ->get()
        //     ->first();

        // $date = date('d/m/Y', strtotime($date_start));

        // // dd($qtdDays);

        // if ($agendas->date == $date_start) {

        //     return true;

        // } else {

        //     return 'exist';




        //     //Loop Days
        //     for ($i = 0; $i <= $qtdDays; $i++) {

        //         $agenda_date = $date_start_obj->format('Y-m-d');
        //         echo '<br>';
        //         echo $agenda_date;
        //         echo '<br>';

        //         $date_start_obj->modify('+1 day');
        //     }
        // }

        // return die;
    }
}
