<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Professional;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class AgendaController extends Controller
{
    public function index($id)
    {

        // $agendas = Agenda::where('professional_id', '=', $id)->get();

        // $agendas = Agenda::groupBy('date')
        //                     ->where('professional_id', $id)
        //                     ->orderByDesc('date')
        //                     ->get();

        // $registros = ModeloA::join('tabela_b', 'tabela_a.id', '=', 'tabela_b.modelo_a_id')
        //             ->join('tabela_c', 'tabela_b.id', '=', 'tabela_c.modelo_b_id')
        //             ->select('tabela_a.*', 'tabela_b.*', 'tabela_c.*')
        //             ->where('tabela_a.campo', '=', 'valor')
        //             ->get();

        $agendas = Agenda::join('professionals', 'professionals.id', '=', 'agendas.professional_id')
            ->select('agendas.*', 'professionals.name')
            ->where('agendas.professional_id', $id)
            ->get();

            dd($agendas);



        return view('admin.agenda.agendas', compact('agendas'));

    }
}
