@extends('layouts.app')

@section('content')
<div class="container">
<html>
<form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('empleado.form',['modo'=>'Crear'])    
</form>
</html>
</div>
@endsection
