@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar usuarios</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($user, array('route' => array('admin.user.update', $user), 'autocomplete' => 'off')) !!}

                <input type="hidden" name="_method" value="PUT">

                @include('admin.user.form')

            {!! Form::close() !!}
        </div>
    </div>

@endsection