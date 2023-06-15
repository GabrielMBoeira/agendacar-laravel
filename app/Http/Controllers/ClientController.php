<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientFormRequest;
use App\Models\Agenda;
use App\Models\Client;
use App\Models\Service;
use App\Models\User;
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

        $services = Service::select(['id','service'])
                        ->where('user_id', $user->id)
                        ->get();

        $professionals = $user->professionals;

       return view('client.agenda', compact('user', 'services'));

    }

    public function ajaxDate(Request $request)
    {

        $service_id = $request->input('service_id');

        $agendas = Agenda::select('agendas.date')
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

    public function store(StoreClientFormRequest $request, Client $client)
    {

        if ($request->password != $request->confirm_password) {
            return redirect()->route('client.create')->with('msg', 'Senhas não estão iguais, verifique senhas.');
        }

        try {
            $client->name = $request->name;
            $client->email = $request->email;
            $client->password = bcrypt($request->password);
            $client->save();
        } catch (\Throwable $th) {
            if ($th->errorInfo[0] == '23000') {
                return redirect()->route('client.create')->with("msg", "Email ($request->email) já encontra-se cadastrado");
            }
        }

        return redirect()->route('client.link')->with('msg', 'Usuário cadastrado com sucesso.');
    }
}
