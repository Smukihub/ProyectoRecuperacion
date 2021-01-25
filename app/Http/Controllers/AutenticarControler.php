<?php

namespace App\Http\Controllers;

use App\Events\UsuarioRegistrado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Usuario;
use App\Models\Categoria;


class AutenticarControler extends Controller
{
    public function autenticar(){
        return view('autenticar');
    }
    public function registrar(){
        return view('registrar');
    }
    public function salir(){
        Auth::logout();
        return redirect('/');
    }

    public function agregar(Request $request)
    {

        $valores = $request->all();
        if ($valores['password']!=$valores['password2'])
            return redirect()->back()->with('error','El password no esta bien confirmado');

        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            $ruta_destino = public_path('fotos/');
            $nombre_de_archivo = $imagen->getClientOriginalName();
            $imagen->move($ruta_destino, $nombre_de_archivo);
            $valores['imagen']=$nombre_de_archivo;
        }
        $valores['rol']="Cliente";
        $valores['password']=Hash::make( $valores['password'] );

        $registro = new Usuario();
        $registro->fill($valores);
        $registro->save();

        Auth::login($registro);
        event(new UsuarioRegistrado($registro, $request->ip()));
        return  redirect('/tablero');
    }
    public function validar(Request $request)
    {
        $nombre   = $request->input('usuario');
        $usuario = Usuario::where('nombre',$nombre)->first();
        if(is_null($usuario))
            return  redirect('/autenticar')->with('error', 'Usuario no registrado');
        else{
            $password = $request->input('password');
            $password_bd = $usuario->password;
            if (Hash::check($password, $password_bd)) {
                Auth::login($usuario);
                return  redirect('/tablero');
            }else
                return redirect('/autenticar')->with('error', 'Usuario no registrado');
        }

    }
}
