@extends('layouts.app')

@section('title', 'Mis publicaciones')

@section('content')

    <div class="container">
        <div class="row justify-content-center mt-3 mb-3">
            <h1>Mis Publicaciones</h1>
        </div>
        <div class="row justify-content-center">
            @if(session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
            @endif
            
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Imágen</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <th scope="col"></th>
                    <th class= "" scope="col"></th>
                </tr>
            </thead>
            @if (count($productos) > 0)
            <tbody>            
                @foreach ($productos as $producto)
                <tr>
                    <td><img src="imagenes/{{$producto->imagen}}" alt="" width="100" height="100"></td>
                    <td>{{$producto->nombre}}</td>
                    <td>${{number_format($producto->precio, 0, '.', ',')}} COP</td>
                    
                    @if ($producto->stock == 1)
                        <td>{{$producto->stock}} Unidad</td>
                    @elseif ($producto->stock == 0)
                        <td>Sin unidades</td>
                    @else
                        <td>{{$producto->stock}} Unidades</td>
                    @endif
                    
                    <td><a href="/productos/{{$producto->slug}}/edit" class="btn btn-primary">Editar producto</a></td>
                    
                    {{-- <td>
                        {!! Form::open(['route'=> ['productos.destroy', $producto->slug],'method'=> 'DELETE']) !!}
                            {!! Form::submit('Eliminar producto', ['class' => 'btn btn-danger'])!!}
                        {!! Form::close()!!}
                    </td> --}}
                    
                    <td>
                        <a  href="{{ route('productos.destroy', $producto->slug) }}" class="btn btn-danger btn-xs" onclick="event.preventDefault();if(confirm('¿Está seguro que desea desactivar este producto?')){document.getElementById('desactivar-producto-{{$producto->slug}}').submit()};">Desactivar producto</a>
                
                        <form id="desactivar-producto-{{$producto->slug}}" method="POST" action="{{ route('productos.destroy', $producto->slug) }}" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @else
            <div class="row justify-content-center">
                <div class="alert alert-warning text-center">
                    Es posible que haya desactivado sus productos publicados<br>o no haya publicado ninguno aún.
                </div>
            </div>
                
            @endif
        </table>
    </div>
@endsection