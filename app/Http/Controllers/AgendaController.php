<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgendaDate;
use App\Models\Agenda;
use App\Models\Professional;
use App\Models\Service;
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

        $this->insertDatesInAgenda($professional_id, $date_start, $date_end, $interval);

        return redirect()->route('admin.agenda.index', compact('professional_id'))->with('msg', 'Agendamento cadastrado com sucesso!');
    }

    public function view($date, $professional_id)
    {

        $agendas = Agenda::where('date', '=', $date)
            ->where('professional_id', '=', $professional_id)->get();

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

        $scheduling = Agenda::findOrFail($request->agenda_id);
        $scheduling->client = $request->client;
        $scheduling->email = $request->email;
        $scheduling->service = $request->service;
        $scheduling->updated_at = date('Y-m-d H:i:s', $request->server('REQUEST_TIME'));
        $scheduling->save();

        $date = $scheduling->date;
        $professional_id =  $scheduling->professional_id;

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

        return redirect()->route('admin.agenda.view', [$agenda->date, $agenda->professional_id])->with('msg', 'Agenda deletada com sucesso!');
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
        $scheduling->client = '-';
        $scheduling->email = '-';
        $scheduling->service = '-';
        $scheduling->save();

        $date = $scheduling->date;
        $professional_id =  $scheduling->professional_id;

        return redirect()->route('admin.agenda.view', compact('date', 'professional_id'))->with('msg', 'Agenda limpa com sucesso!');

    }
}
