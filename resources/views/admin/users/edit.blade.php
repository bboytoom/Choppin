@extends('layouts.admin_layout')

@section('title', 'Complemento del usuario' )

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">
        {{ $name. ' '. $paterno. ' '. $materno }}
    </h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Direcciones de envio</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="https://blackrockdigital.github.io/startbootstrap-sb-admin-2/img/undraw_posting_photo.svg" alt="">
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum mauris lorem, 
                        id feugiat arcu eleifend et. Proin finibus fermentum turpis volutpat volutpat. Praesent enim justo, 
                        eleifend in ultrices a, posuere ut sapien. 
                    </p>

                    <a href="{{route('shippings.index', $id)}}" class="mt-4" rel="nofollow" style="float: right;">
                        Ver direcciones →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos de facturacion</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="https://blackrockdigital.github.io/startbootstrap-sb-admin-2/img/undraw_posting_photo.svg" alt="">
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum mauris lorem, 
                        id feugiat arcu eleifend et. Proin finibus fermentum turpis volutpat volutpat. Praesent enim justo, 
                        eleifend in ultrices a, posuere ut sapien. 
                    </p>

                    <a href="#" class="mt-4" rel="nofollow" style="float: right;">
                        Ver datos de facturacion →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-5 text-right">
            <a href="{{ route('users.index') }}" type="button" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">
                    Regresar
                </span>
            </a>
        </div>
    </div>

@endsection
