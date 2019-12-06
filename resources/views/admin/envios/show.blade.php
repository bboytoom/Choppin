@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Datos de envio</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 text-right">
			<a href="{{ route('admin.user.index') }}" class="btn btn-info btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fa fa-plus-circle"></i>
                </span>
                <span class="text">Regresar</span>
            </a>
            
            <a href="{{ route('admin.envios.create', $user_id) }}" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fa fa-plus-circle"></i>
                </span>
                <span class="text">Agregar</span>
            </a>
        </div>

        <div class="card-body">
            @if ($envios->count() === 0)
                <h4 class="text-center">No cuentas con ninguna direccion de envio</h4> 
            @else
                <div class="table-responsive">
					<table id="envios" class="table table-bordered table-hover" width="100%" cellspacing="0">
						<thead>
							<tr>
                                <th>Direccion</th>
                                <th>Colonia</th>
                                <th>Municipio</th>
                                <th class="text-center">Estatus</th>
								<th class="text-center">Editar</th>
								<th class="text-center">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							@foreach($envios as $envio)
								<tr>
                                    <td>{{ $envio->direccion }}</td>
                                    <td>{{ $envio->colonia }}</td>
                                    <td>{{ $envio->municipio }}</td>
                                    <td class="text-center">
                                        @if ($envio->status == 1)
                                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </td>
									<td class="text-center">
										<a href="{{ route('admin.envios.edit', $envio->id) }}" class="btn btn-warning btn-circle">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
									</td>
									<td class="text-center">
                                        <form action="{{ route('admin.envios.destroy', $envio->id) }}" method="POST">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}

											<button type="submit" onClick="return confirm('Eliminar registro?')" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
            @endif
        </div>
    </div>

@endsection