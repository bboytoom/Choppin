@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Agregar usuarios</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::open(['route'=>'admin.user.store', 'autocomplete' => 'off']) !!}

                @include('admin.user.form')
                
            {!! Form::close() !!}
        </div>
    </div>

@endsection
