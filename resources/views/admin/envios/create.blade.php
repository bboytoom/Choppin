@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Crear direccion de envio</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::open(['route'=>'admin.envios.store', 'autocomplete' => 'off']) !!}
                <input type="hidden" name="user_id" value="{{ $user_id }}">

                @include('admin.envios.form')

            {!! Form::close() !!}
        </div>
    </div>

@endsection