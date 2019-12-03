@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Agregar caracteristicas</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::open(['route'=>'admin.characteristics.store', 'autocomplete' => 'off']) !!}
                <input type="hidden" name="producto_id" value="{{ $producto_id }}">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="caracteristica">Caracteristica:</label>
                            {!! Form::text('caracteristica', null, array('class'=>'form-control', 'placeholder' => 'Color')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            {!! Form::text('descripcion', null, array('class'=>'form-control', 'placeholder' => 'Azul')) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group text-right mt-5">
                    <a href="{{ route('admin.characteristics.show', $producto_id) }}" class="btn btn-info btn-icon-split">
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