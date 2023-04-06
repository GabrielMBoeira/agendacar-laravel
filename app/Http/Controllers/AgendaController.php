<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Professional;
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

        return view('admin.agenda.agendas_show', compact('scheduling', 'professional'));
    }

    public function store(Request $request)
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

    public function destroy($agenda_id) {

        try {

            $agenda = Agenda::findOrFail($agenda_id);
            $agenda->delete();

        } catch (\Illuminate\Database\QueryException $ex) {

            $errorCode = $ex->errorInfo[1];

            if ($errorCode == 1451) {
                return redirect()->route('admin.agenda.index', $agenda->professional_id)->with('msg', 'Não é possível excluir este agendamento.');
            }

        }

        return redirect()->route('admin.agenda.view', [$agenda->date, $agenda->professional_id])->with('msg', 'Profissional deletado com sucesso!');

    }
}
