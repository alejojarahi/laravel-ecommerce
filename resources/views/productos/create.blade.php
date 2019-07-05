@extends('layouts.app')

@section('title', 'Publicar producto nuevo')

@section('content')

    <form class="form-group" method="POST" action="/productos" enctype="multipart/form-data">

        @csrf
        <div class="row justify-content-center mt-3 mb-3">
            <h1>Publicar producto</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form>
                    <div class="form-group">
                        <label for="Nombre">Nombre del producto</label>
                        <input type="text" class="form-control" name="nombre">
                        @error('nombre')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Precio">Precio (cop)</label>
                        <input type="text" class="form-control" name="precio">
                        @error('precio')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="Categoria">Tipo</label>
                        <select type="text" class="form-control" name="tipo">
                            <option type="text" selected="selected">Tecnologia</option>
                            <option type="text">Ropa</option>
                            <option type="text">Calzado</option>
                            <option type="text">Hogar</option>
                        </select>
                        @error('tipo')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Stock">Stock</label>
                        <input type="text" class="form-control" name="stock" >
                        @error('stock')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Desc">Descripción</label>
                        <textarea type="text" class="form-control" name="descripcion" rows="5"></textarea>
                        @error('stock')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imágen</label>
                        <input type="file" name="imagen" required>
                    </div>
                    <div class="row justify-content-center m-3">
                        <div class="col d-flex justify-content-end">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalBack">Regresar</a>
                        </div>
                        <div class="col d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary" href="#">Publicar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
@endsection