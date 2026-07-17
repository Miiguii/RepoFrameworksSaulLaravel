@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Editar usuario</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Nueva contraseña</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Rol</label>
                    <select name="role_id" id="role_id" class="form-select" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->tipo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
