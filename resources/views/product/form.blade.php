<div class="box box-info padding-1">
    <div class="box-body">
        

        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $product->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            <div class="name-error invalid-feedback">{{ $errors->first('name') }}</div>
        </div>
        <div class="form-group">
            {{ Form::label('Precio (en euros)') }}
            {{ Form::number('price', $product->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Precio', 'step'=>'0.01']) }}
            <div class="price-error invalid-feedback">{{ $errors->first('name') }}</div>
        </div>
        <div class="form-group">
            {{ Form::label('Observaciones') }}
            {{ Form::text('observations', $product->observations, ['class' => 'form-control' . ($errors->has('observations') ? ' is-invalid' : ''), 'placeholder' => 'Observaciones']) }}
            <div class="observations-error invalid-feedback">{{ $errors->first('name') }}</div>
        </div>


    
        <div class="form-group">
            {{ Form::label('Categoría') }}
            {{ Form::select('category_id', $categories,$product->category_id, ['class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : ''), 'placeholder' => 'Categoría']) }}
            <div class="category-error invalid-feedback">{{ $errors->first('name') }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('warehouse_ids', 'Almacenes') }}
            @foreach($warehouses as $warehouseId => $warehouseName)
            
            <div class="form-check">
                {{ Form::checkbox('warehouse_ids[]', $warehouseId, in_array($warehouseId, $product->warehouses->pluck('id')->toArray()), ['class' => 'form-check-input']) }}
                {{ Form::label(null, $warehouseName, ['class' => 'form-check-label']) }}
                <div class="warehouse-error invalid-feedback"></div>
            </div>
            @endforeach
            
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>