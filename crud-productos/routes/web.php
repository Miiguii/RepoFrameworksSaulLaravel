<?php

use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\HorarioController;

Route::get('/', function () {
    return redirect()->route('escuelas.index');
});

Route::resource('escuelas', EscuelaController::class);
Route::resource('alumnos', AlumnoController::class);
Route::resource('personal', PersonalController::class);
Route::resource('carreras', CarreraController::class);
Route::resource('asignaturas', AsignaturaController::class);
Route::resource('horarios', HorarioController::class);