<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // para eliminar foto

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        $datos['empleados'] = Empleado::paginate(5);
        return view('empleado.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
      
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'nombre' =>'required | string |max:100',
            'apellidoPaterno' =>'required|string|max:100',
            'apellidoMaterno' =>'required|string|max:100',
            'correo' =>'required|email',
            'foto' =>'required|max:1000|mimes:jpg,png,jpeg' 
        ];
        $Mensaje =['required'=> 'El :attribute es requerido',
                    'Foto,required'=>'La foto es requerida'];
        $this->validate($request,$campos,$Mensaje); 

        $datosEmpleado = $request->except('_token'); // obtengo todos los datos de empleados
        if($request->hasFile('foto')) {
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads','public');
            }
        Empleado::insert($datosEmpleado);
       // return response()->json($datosEmpleado); // retorna los datos en formato Json
        return redirect('empleado')->with('mensaje', 'Empleado agregado exitosamente!!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $emp = Empleado::findOrFail($id); // me traigo el eregistro del id seleccionado
        return view('empleado.edit' , compact('emp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'nombre' =>'required | string |max:100',
            'apellidoPaterno' =>'required|string|max:100',
            'apellidoMaterno' =>'required|string|max:100',
            'correo' =>'required|email'
            
        ];
        $Mensaje =['required'=> 'El :attribute es requerido',
                    'foto.required'=>'La foto es requerida'];
        $this->validate($request,$campos,$Mensaje); 


        if($request->hasFile('foto')) {
            $campos=['foto' =>'required|max:1000|mimes:jpg,png,jpeg']; 
            $Mensaje =['foto.required'=>'La foto es requerida'];
        }

        $datosEmpleado = request()->except(['_token','_method']);

        if($request->hasFile('foto')) 
            {
            $emp = Empleado::findOrFail($id); // busco el id  selecionado
            Storage::delete('public/'.$emp->foto);    
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads','public');
            }
        Empleado::where('id','=',$id)->update($datosEmpleado);

        $emp = Empleado::findOrFail($id); // me traigo el registro del id seleccionado
       // return view('empleado.edit' , compact('emp'));

       return redirect('empleado')->with('mensaje', 'Empleado Modificado exitosamente!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       $empleado = Empleado::findOrfail($id);
       if(Storage::delete('public/'.$empleado->Foto)) {
          
        Empleado::destroy($id); // elimino el registro
       
        }
        
       
        return redirect('empleado')->with('mensaje', 'Empleado borrado exitosamente!!');
    }
}
