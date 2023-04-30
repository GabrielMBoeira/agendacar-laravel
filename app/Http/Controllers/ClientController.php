<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientFormRequest;
use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\VarDumper;

use function PHPUnit\Framework\isEmpty;

class ClientController extends Controller
{
    public function login(Request $request, User $user_model)
    {

        $hash = urldecode($request->input('hash'));

        if (!$user = $user_model::where('hash', $hash)->get()->first()) {
            return view('site.site');
        }

        $professionals = $user->professionals;

       return view('client.login', compact('user', 'professionals'));

    }

    public function index()
    {

        dd('index');

    }

    public function link()
    {

        $user = auth()->user();
        $user_hash = urlencode($user->hash);

        return redirect()->route('client.login', ['hash' => $user_hash]);

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

        return redirect()->route('client.login')->with('msg', 'Usuário cadastrado com sucesso.');
    }
}
