@extends('layouts.app')

@section('template_title')
    Crear almacén
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear almacén</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="warehouse-form" action="{{ route('warehouses.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('warehouse.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
