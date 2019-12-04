@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar direccion de envio</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($envios, array('route' => array('admin.envios.update', $envios->id), 'autocomplete' => 'off')) !!}
                <input type="hidden" name="_method" value="PUT">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="calle_uno">Calle uno:</label>
                            {!! Form::text('calle_uno', null, array('class'=>'form-control', 'placeholder' => 'Calle uno')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="calle_dos">Calle uno:</label>
                            {!! Form::text('calle_dos', null, array('class'=>'form-control', 'placeholder' => 'Calle dos')) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="direccion">Direccion:</label>
                    {!! Form::text('direccion', null, array('class'=>'form-control', 'placeholder' => 'Direccion')) !!}
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="colonia">Colonia:</label>
                            {!! Form::text('colonia', null, array('class'=>'form-control', 'placeholder' => 'Colonia')) !!}
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="municipio">Municipio:</label>
                            {!! Form::text('municipio', null, array('class'=>'form-control', 'placeholder' => 'Municipio')) !!}
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            {!! Form::text('estado', null, array('class'=>'form-control', 'placeholder' => 'Estado')) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pais">Pais:</label>
                            {!! Form::text('pais', null, array('class'=>'form-control', 'placeholder' => 'Pais')) !!}
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="codigo_postal">Codigo postal:</label>
                            {!! Form::text('codigo_postal', null, array('class'=>'form-control', 'placeholder' => 'Codigo postal')) !!}
                        </div>
                    </div>
                    
                    <div class="col-md-4 mt-3">
                        <div class="custom-control custom-switch text-right">
                            <input id="status" type="checkbox" class="custom-control-input" name="status" {{ $envios->status == 1 ? "checked='checked'" : '' }}>
                            <label class="custom-control-label" for="status">Estatus</label>
                        </div>
                    </div>
                </div>

                <div class="form-group text-right mt-5">
                    <a href="{{ route('admin.envios.show', $envios->user_id) }}" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Cancelar</span>
                    </a>

                    <button type="submit" class="btn btn-danger btn-icon-split">
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