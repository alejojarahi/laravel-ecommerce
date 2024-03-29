<?php

namespace Application\Http\Controllers;

use Illuminate\Http\Request;
use Application\Producto;
use Application\Carrito;
use Illuminate\Http\Resources\Json\Resource;
use phpDocumentor\Reflection\Types\Resource_;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $carritos = Carrito::where('Carritos.emailUser',$user->email)
                            ->leftJoin('productos','carritos.IdProducto','=','productos.id')
            ->get();
        $total =0;
        foreach ($carritos as $carrito) {
            $total = ($carrito->precio)*$carrito->cantidad + $total;
        }
        return view('productos.Carrito',compact ('carritos','total'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $resource,$id)
    {
        $resource->user()->authorizeRoles(['comprador']);

        $user = auth()->user();
        $validacion = $resource -> validate([
            'cantidad' => 'integer|min:1',
        ],['cantidad.min'    => 'La cantidad debe ser superior a 1']);
        if($producto = Producto::where('id', $id)->first()){
            $carrito = new Carrito();
            $carrito->IdProducto=$id;
            $carrito->emailUser = $user->email;
            $carrito->cantidad = $resource->cantidad;
            $carrito->total= ($resource->cantidad)*($producto->precio);
            $carrito->save();
            return redirect('/productos')->with('message', 'Se ha añadido al carrito satisfactoriamente');;
        }else{
            return "El producto no existe";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($carrito = Carrito::where('idCarrito', $id)->delete()){
            return redirect()->back()->with('message', 'Se ha eliminado el producto del carrito');
        }else {
            return redirect()->back()->with('message', 'El producto ya no existe en el carrito');
        }
    }
}
