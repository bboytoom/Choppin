@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar categoriar</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($category, array('route' => array('admin.category.update', $category))) !!}
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    {!! Form::text('name', null, array('class'=>'form-control', 'placeholder' => 'Nombre')) !!}
                </div>
                 
                <div class="form-group">
                    <label for="description">Descripción:</label>
                    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Agrega una descripcion')) !!}
                </div>

                <div class="form-group text-right mt-5">
                    <a href="{{ route('admin.category.index') }}" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Cancelar</span>
                    </a>

                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <span class="text">Guardar</span>
                    </button>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection