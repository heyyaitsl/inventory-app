<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('product_id') }}
            {{ Form::select('product_id', $products, $productHasWarehouse->product_id, ['class' => 'form-control' . ($errors->has('product_id') ? ' is-invalid' : ''), 'placeholder' => 'Product Id']) }}
            {!! $errors->first('product_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('warehouse_id') }}
            {{ Form::select('warehouse_id', $warehouses, $productHasWarehouse->warehouse_id, ['class' => 'form-control' . ($errors->has('warehouse_id') ? ' is-invalid' : ''), 'placeholder' => 'Warehouse Id']) }}
            {!! $errors->first('warehouse_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>