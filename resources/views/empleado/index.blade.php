@extends('layouts.app')
@section('content')

    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
            
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>  
    @endif

<div class="container">


<a href="{{ url('empleado/create') }}" class="btn btn-success"> Registrar nuevo Empleado</a>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $emp)
        <tr>
            <td>{{ $emp->id }}</td>
            <td>
                <img  class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$emp->Foto }}" width="100" alt="">
            </td>
            <td>{{ $emp->Nombre }}</td>
            <td>{{ $emp->ApellidoPaterno }}</td>
            <td>{{ $emp->ApellidoMaterno }}</td>
            <td>{{ $emp->Correo }}</td>
            <td> <a href="{{ url('/empleado/'.$emp->id.'/edit') }}"  class="btn btn-warning">Editar</a> | 
                <form action="{{ url('/empleado/'.$emp->id) }}" method="post" class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input  class="btn btn-danger" type="submit" onclick="return confirm('Deseas borrar este registro?')" value="Borrar">
                </form> 
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- {!!  $empleados->links() !!} -->
</div>
@endsection