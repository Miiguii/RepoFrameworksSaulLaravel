<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\SanitizesData;
use App\Models\Personal;
use App\Models\TipoPersonal;
use App\Models\DatosPersonales;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    use SanitizesData;
    public function index()
    {
        $personal = Personal::with(['tipo', 'datosPersonales'])->paginate(10);
        return view('personal.index', compact('personal'));
    }

    public function create()
    {
        $tipos = TipoPersonal::all();
        $datosPersonales = DatosPersonales::all();
        return view('personal.create', compact('tipos', 'datosPersonales'));
    }

    public function store(Request $request)
    {
        $data = $this->sanitizeData($request->validate([
            'IdDatosP' => 'required|exists:datos_personales,IdDatosP',
            'IdTipo' => 'required|exists:tipos_personal,idTipo',
            'ClaveEmp' => 'required|string|size:10|unique:personal',
            'Status' => 'required|boolean',
        ]));

        Personal::create($data);
        return redirect()->route('personal.index')->with('success', 'Personal creado exitosamente.');
    }

    public function show(Personal $personal)
    {
        $personal->load(['tipo', 'datosPersonales', 'horarios']);
        return view('personal.show', compact('personal'));
    }

    public function edit(Personal $personal)
    {
        $tipos = TipoPersonal::all();
        $datosPersonales = DatosPersonales::all();
        return view('personal.edit', compact('personal', 'tipos', 'datosPersonales'));
    }

    public function update(Request $request, Personal $personal)
    {
        $data = $this->sanitizeData($request->validate([
            'IdTipo' => 'required|exists:tipos_personal,idTipo',
            'Status' => 'required|boolean',
        ]));

        $personal->update($data);
        return redirect()->route('personal.index')->with('success', 'Personal actualizado exitosamente.');
    }

    public function destroy(Personal $personal)
    {
        $personal->delete();
        return redirect()->route('personal.index')->with('success', 'Personal eliminado exitosamente.');
    }
}