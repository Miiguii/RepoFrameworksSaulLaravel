<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\SanitizesData;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    use SanitizesData;
    public function index()
    {
        $carreras = Carrera::paginate(10);
        return view('carreras.index', compact('carreras'));
    }

    public function create()
    {
        return view('carreras.create');
    }

    public function store(Request $request)
    {
        $data = $this->sanitizeData($request->validate([
            'NombreCarreras' => 'required|string|max:50|unique:carreras',
            'Estatus' => 'required|boolean',
        ]));

        Carrera::create($data);
        return redirect()->route('carreras.index')->with('success', 'Carrera creada exitosamente.');
    }

    public function show(Carrera $carrera)
    {
        return view('carreras.show', compact('carrera'));
    }

    public function edit(Carrera $carrera)
    {
        return view('carreras.edit', compact('carrera'));
    }

    public function update(Request $request, Carrera $carrera)
    {
        $data = $this->sanitizeData($request->validate([
            'NombreCarreras' => 'required|string|max:50|unique:carreras,NombreCarreras,' . $carrera->IdCarrera . ',IdCarrera',
            'Estatus' => 'required|boolean',
        ]));

        $carrera->update($data);
        return redirect()->route('carreras.index')->with('success', 'Carrera actualizada exitosamente.');
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return redirect()->route('carreras.index')->with('success', 'Carrera eliminada exitosamente.');
    }
}