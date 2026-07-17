<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\SanitizesData;
use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    use SanitizesData;
    public function index()
    {
        $asignaturas = Asignatura::paginate(10);
        return view('asignaturas.index', compact('asignaturas'));
    }

    public function create()
    {
        return view('asignaturas.create');
    }

    public function store(Request $request)
    {
        $data = $this->sanitizeData($request->validate([
            'Nombre' => 'required|string|max:50|unique:asignaturas',
            'HorasTotales' => 'required|integer|min:1|max:500',
        ]));

        Asignatura::create($data);
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura creada exitosamente.');
    }

    public function show(Asignatura $asignatura)
    {
        return view('asignaturas.show', compact('asignatura'));
    }

    public function edit(Asignatura $asignatura)
    {
        return view('asignaturas.edit', compact('asignatura'));
    }

    public function update(Request $request, Asignatura $asignatura)
    {
        $data = $this->sanitizeData($request->validate([
            'Nombre' => 'required|string|max:50|unique:asignaturas,Nombre,' . $asignatura->idAsignatura . ',idAsignatura',
            'HorasTotales' => 'required|integer|min:1|max:500',
        ]));

        $asignatura->update($data);
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura actualizada exitosamente.');
    }

    public function destroy(Asignatura $asignatura)
    {
        $asignatura->delete();
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura eliminada exitosamente.');
    }
}