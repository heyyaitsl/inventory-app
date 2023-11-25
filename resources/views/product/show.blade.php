@extends('layouts.app')

@section('template_title')
    {{ $product->name }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{$product->name}}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('products.index') }}"> Atrás</a>
                        </div>
                        
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $product->name }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $product->price }} €
                        </div>
                        <div class="form-group">
                            <strong>Observaciones:</strong>
                            {{ $product->observations }}
                        </div>
                        <div class="form-group">
                            <strong>Categoría:</strong>
                            {{ $product->category->name }}
                        </div>
                        <div class="form-group">
                            <strong>Almacenes:</strong>
                            <ul>
                                @foreach ($product->warehouses as $warehouse)
                                    <li>{{ $warehouse->name }}<br></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>
@endsection
