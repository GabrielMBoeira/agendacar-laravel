<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Service;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function agenda(Request $request, User $user_model)
    {

        $hash = urldecode($request->input('hash'));

        if (!$user = $user_model::where('hash', $hash)->get()->first()) {
            return view('site.site');
        }

        $agendas =  Agenda::select('date')
            ->distinct()
            ->where('user_id', $user->id)
            ->get();

        $services = Service::select(['id', 'service'])
            ->where('user_id', $user->id)
            ->get();

        $professionals = $user->professionals;

        return view('client.agenda', compact('user', 'services'));
    }

    public function ajaxDate(Request $request)
    {

        $service_id = $request->input('service_id');

        $agendas = Agenda::select(['agendas.date', 'agendas.professional_id', 'professionals.name'])
            ->distinct()
            ->leftJoin('professionals', 'professionals.id', '=', 'agendas.professional_id')
            ->leftJoin('services', 'services.professional_id', '=', 'professionals.id')
            ->where('services.id', $service_id)
            ->orderByDesc('agendas.date')
            ->get();

        return json_encode($agendas);
    }

    public function ajaxAgenda(Request $request)
    {

        $hash = $request->input('hash');
        $date = $request->input('date');

        $agendas = Agenda::select([DB::raw('SUBSTR(agendas.hour, 1, 2) as hour'), DB::raw('SUBSTR(agendas.hour, 4, 2) as minute')])
            ->leftJoin('users', 'users.id', '=', 'agendas.user_id')
            ->where('users.hash', $hash)
            ->where('agendas.date', $date)
            ->where('agendas.status', 'active')
            ->orderBy('agendas.date')
            ->get();

        return json_encode($agendas);
    }

    public function link()
    {

        $user = auth()->user();
        $user_hash = urlencode($user->hash);

        return redirect()->route('client.agenda', ['hash' => $user_hash]);
    }

    public function create()
    {

        return view('client.create');
    }

    public function scheduling(Request $request)
    {

        $user = User::where('hash', $request->hashForm)->first();
        $service = Service::findOrFail($request->serviceForm);
        $scheduling_hour_dt = DateTime::createFromFormat('H:i:s', $request->btn_agenda_hour . ':00');
        $hour = substr($service->time_service, 0, 2);
        $minute = substr($service->time_service, 3, 2);

        //Adicionando tempo do serviço ao agendamento solicitado
        $scheduling_add = $scheduling_hour_dt->add(new DateInterval('PT' . $hour . 'H' . $minute . 'M'));

        $schedulings = Agenda::where('professional_id',  $service->professional_id)
            ->where('user_id', $user->id)
            ->where('date', $request->dateForm)->get();

        //Check conflito de horários
        foreach ($schedulings as $scheduling) {

            if ($scheduling->hour >= $request->btn_agenda_hour . ':00') {

                $next_scheduling = DateTime::createFromFormat('H:i:s', $scheduling->hour);

                //Se serviço + solicitação de agenda for maior que agendamento cadastrado, irá entrar.
                if ($scheduling_add > $next_scheduling) {

                    //Verifica se há cliente cadastrado no agendamento posterior
                    if ($scheduling->client != "") {
                        echo 'aqui';
                        die;
                        return back()->with('msg', 'Conflito de horário: Tempo de serviço é maior que horário disponível!');
                    }
                }
            }
        }

        //Salvando horários nos agendamentos
        foreach ($schedulings as $scheduling) {

            if ($scheduling->hour >= $request->btn_agenda_hour . ':00') {

                $next_scheduling = DateTime::createFromFormat('H:i:s', $scheduling->hour);

                //Se serviço + solicitação de agenda for maior que agendamento cadastrado, irá entrar.
                if ($scheduling_add > $next_scheduling) {

                    $scheduling->client = $request->nameForm;
                    $scheduling->email = $request->emailForm;
                    $scheduling->phone = $request->phoneForm;
                    $scheduling->service = $request->serviceForm;
                    $scheduling->updated_at = date('Y-m-d H:i:s', $request->server('REQUEST_TIME'));
                    $scheduling->save();
                }
            }
        }

        return back()->with('msg', 'Cliente cadastrado com sucesso!');
    }
}
