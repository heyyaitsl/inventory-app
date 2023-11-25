<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $warehouse->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('product_ids', 'Productos a guardar') }}
            @foreach($products as $productId => $productName)
            <div class="form-check">
                {{ Form::checkbox('product_ids[]', $productId, in_array($productId, $warehouse->products->pluck('id')->toArray()), ['class' => 'form-check-input']) }}
                {{ Form::label(null, $productName, ['class' => 'form-check-label']) }}
            </div>
            @endforeach
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Editar</button>
    </div>
</div>