<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Professional;

class AgendaController extends Controller
{
    public function index($id)
    {
        $professional = Professional::findOrFail($id);
        $professional_name = mb_convert_case($professional->name, MB_CASE_TITLE, "UTF-8");

        $agendas = Agenda::where('professional_id', '=', $id)
                            ->groupBy('date')
                            ->get();

        return view('admin.agenda.agendas', ['professional_name' => $professional_name, 'agendas' => $agendas]);

    }
}
