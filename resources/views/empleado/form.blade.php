<h1>{{ $modo }} Empleado </h1>
@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
        <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }} </li>
                @endforeach
        </ul>        

</div>
@endif
<!-- Formulario que tendra datos en comun con create y edit -->
 <div class="form-group">
        <label for="nombre" >Nombre</label>
        <input class="form-control" type="text" id="nombre" name="nombre" value="{{ isset($emp->Nombre) ? $emp->Nombre : old('nombre') }}" placeholder="nombre"><br>
<br> 
</div>
 <div class="form-group">
        <label for="apellidoP">Apellido Paterno</label>
        <input class="form-control" type="text" id="apellidoP" name="apellidoPaterno" value="{{ isset($emp->ApellidoPaterno) ? $emp->ApellidoPaterno : old('apellidoPaterno') }}" placeholder="apellido paterno"><br>
<br> 
</div>
 <div class="form-group">
        <label for="apellidoM">Apellido Materno</label>
        <input class="form-control" type="text"  id="apellidoM" name="apellidoMaterno" value="{{ isset($emp->ApellidoMaterno) ? $emp->ApellidoMaterno : old('apellidoMaterno') }}" placeholder="apellido materno"><br>
<br> 
</div>
 <div class="form-group">       
        <label for="email">Correo</label>
        <input  class="form-control" type="text" id="correo" value="{{ isset($emp->Correo) ? $emp->Correo : old('correo')  }}" name="correo" placeholder="email"><br>
<br> 
</div>
 <div class="form-group">      
 <label for="foto">Foto</label>
         @if(isset($emp->Foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$emp->Foto }}" width="100" alt="">
        @endif       
        <input class="form-control" type="file" id="foto" name="foto" ><br><br>
 </div>
        <div class="form-group">
        <input class="btn btn-success" type="submit" value={{ $modo }} Datos>
        <a class="btn btn-primary" href="{{ url('empleado/') }}"> Regresar</a>

