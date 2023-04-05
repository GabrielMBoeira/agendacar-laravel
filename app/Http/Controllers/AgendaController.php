<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Professional;

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

    public function view($date, $professional_id)
    {
        $agendas = Agenda::where('date', '=', $date)
            ->where('professional_id', '=', $professional_id)->get();

        $professional = Professional::findOrFail($professional_id);

        return view('admin.agenda.agenda_view', compact('agendas', 'professional'));
    }
}
