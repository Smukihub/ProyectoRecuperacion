<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Usuario;
use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IncioControler extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        return view('welcome',compact('categorias') );
    }
    public function tablero(){
        
        if (is_null(Auth::user())) die;

        switch (Auth::user()->rol) {
            case 'Supervisor':
                $usuarios = DB::table('usuarios')->count();
                $clientes = DB::select('SELECT count(*) as cuantos from usuarios where rol = "Cliente"')[0]->cuantos;
                $empleados = DB::select('SELECT count(*) as cuantos from usuarios where rol <> "Cliente"')[0]->cuantos;
                $productos = DB::table('productos')->count();
                $concesionados = DB::select('SELECT count(*) as cuantos from productos where concesionado = 1')[0]->cuantos;
                $categorias = DB::table('categorias')->count();
                return  view('tablero', compact('usuarios','clientes','empleados','productos','concesionados','categorias') );
                break;
            case 'Encargado':
                $propuestas = Producto::all()->whereNull('concesionado')->count();
                $preguntas= Pregunta::all()->whereNull('p_autorizada')->count();
                $respuestas= Pregunta::all()->whereNotNull('respuesta')->whereNull('r_autorizada')->count();
                return  view('tablero', compact('propuestas','preguntas','respuestas') );
                break;
            case 'Cliente':
                $productos = DB::table('productos')->where('usuario_id',Auth::id())->count();
                $concesionados = DB::select('SELECT count(*) as cuantos from productos where concesionado = 1 and usuario_id =' . Auth::id()  )[0]->cuantos;
                $preguntas = DB::table('preguntas')->whereNotNull('p_autorizada')->whereNull('r_autorizada')
                            ->whereIn('producto_id', DB::table('productos')->select('id')->where('usuario_id',Auth::id())->get()->pluck('id'))
                            ->count();
                return  view('tablero', compact('productos','concesionados','preguntas') );
                break;
            case 'Contador':
                return view('tablero',[
                    'ventas' => Venta::select('referencia')->groupBy('referencia')->get(),
                    'compradores'=> Usuario::whereIn('id', function($query){
                        $query
                        ->from('ventas')
                        ->select('usuario_id')
                        ->groupBy('usuario_id')
                        ->get();
                    })->get(), // select * from usuario where id in ( select usuario_id from ventas )
                    'vendedores' => Usuario::whereIn('id', function($query){
                        $query
                        ->from('productos')
                        ->groupBy('usuario_id')
                        ->select('usuario_id')
                        ->get();
                    })->get() 
                ]);
            default:
                return view('tablero');
                break;
        }
    }
}


