<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientFormRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function login()
    {

        return view('client.login');
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
