@extends('layouts.app')

@section('template_title')
    {{ $productHasWarehouse->name ?? "{{ __('Show') Product Has Warehouse" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Product Has Warehouse</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('product-has-warehouses.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Product Id:</strong>
                            {{ $productHasWarehouse->product_id }}
                        </div>
                        <div class="form-group">
                            <strong>Warehouse Id:</strong>
                            {{ $productHasWarehouse->warehouse_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
