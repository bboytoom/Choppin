@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
                <i class="fa fa-shopping-cart"></i>
                CATEGORÍAS <small>[Editar categoría]</small>
            </h1>
        </div>

        <div class="col-md-12">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($category, array('route' => array('admin.category.update', $category))) !!}

                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    {!! Form::text('name', null, array( 'class'=>'form-control', 'placeholder' => 'Nombre de la categoria')) !!}
                </div>

                <div class="form-group">
                    <label for="description">Descripción:</label>
                    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Agrega una descripcion')) !!}
                </div>

                <div class="form-group text-right">
                    {!! Form::submit('Actualizar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.category.index') }}" class="btn btn-warning">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </section>

@endsection