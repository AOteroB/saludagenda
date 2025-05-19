@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-secondary"><i class="fas fa-user-cog"></i> {{ $vistaActual }}</h2>
            <p class="text-muted">Desde aquí puedes modificar tu nombre, correo y contraseña.</p>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm border-top border-secondary border-4">
                <div class="card-body">
                    <h5 class="mb-3 text-dark">
                        <i class="fas fa-user-edit mr-2 text-muted"></i> Editar Información Personal
                    </h5>

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name" class="text-muted">Nombre</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="text-muted">Correo electrónico</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="text-muted">Nueva Contraseña <small>(opcional)</small></label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••">
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="text-muted">Confirmar Nueva Contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••">
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-save mr-1"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
    <style>
        .btn-dark {
            background: linear-gradient(135deg, #000000, #888888);
            transition: all 0.3s ease;
        }

        .btn-outline-secondary{
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(99, 99, 99, 0.2));
            border: 1px solid #ccc;
            backdrop-filter: blur(5px);
            color: #333;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover, .btn-dark:hover {
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }
    </style>
@endpush
