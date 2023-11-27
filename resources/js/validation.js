$(document).ready(function() {
    
    $('.product-form').submit(function(e) {
        e.preventDefault();
        
        if(validateProductForm($(this))) {
            sendFormWithAjax($(this));
        }
    });

    $('.category-form').submit(function(e) {
        e.preventDefault();
        
        if(validateCategoryForm($(this))) {
            sendFormWithAjax($(this));
        }
    });

    $('.warehouse-form').submit(function(e) {
        e.preventDefault();
        
        if(validateWarehouseForm($(this))) {
            sendFormWithAjax($(this));
        }
    });

    function sendFormWithAjax(form) {
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if(response.success) {
                    var encodedMessage = encodeURIComponent(response.message);
                    window.location.href = response.redirect + "?message=" + encodedMessage;

                }else {
                    alert(response.message);
                }
            },
            error: function(response) {
                console.log(response);
                alert(response.message);
            }
        });
    }

    function validateCategoryForm(form) {
        var name = form.find('input[name="name"]').val();

        if(name == '') {
            form.find('input[name="name"]').addClass('is-invalid');
            showMessage(".name-error",'El nombre de la categoría es requerido.');
            return false;
        }
       
        cleanMessage("input[name='name']",".name-error");
        return true;
    }

    function validateWarehouseForm(form) {
        var name = form.find('input[name="name"]').val();

        if(name == '') {
            form.find('input[name="name"]').addClass('is-invalid');
            showMessage(".name-error",'El nombre del almacén es requerido.');
            return false;
        }
       
        cleanMessage("input[name='name']",".name-error");
        return true;
    }

    function validateProductForm(form) {
        var name = form.find('input[name="name"]').val();
        var price = form.find('input[name="price"]').val();
        var observations = form.find('input[name="observations"]').val();
        var category_id = form.find('select[name="category_id"]').val();

        var warehouses_id = form.find('input[name="warehouse_ids[]"]:checked').map(function() {
            return this.value;
        }).get().join(',');
        
        var error=0;
        if(name == '') {
            form.find('input[name="name"]').addClass('is-invalid');
            showMessage(".name-error",'El nombre del producto es requerido.');
            error++;
        }else{
            cleanMessage('input[name="name"]',".name-error");
        }
        if(name!='' && name.length < 3) {
            form.find('input[name="name"]').addClass('is-invalid');
            showMessage(".name-error",'El nombre del producto no puede tener menos de 3 caracteres.');
            error++;
        }else if(name!=''){
            cleanMessage('input[name="name"]',".name-error");
        }
        if(price == '') {
            form.find('input[name="price"]').addClass('is-invalid');
            showMessage(".price-error",'El precio del producto es requerido.');
            error++;
        }else{
            cleanMessage('input[name="price"]',".price-error");
        }
        if(price < 0) {
            form.find('input[name="price"]').addClass('is-invalid');
            showMessage(".price-error",'El precio del producto debe ser positivo.');
            error++;
        }else if(price!=''){
            cleanMessage('input[name="price"]',".price-error");
        }
        if(observations == '') {
            form.find('input[name="observations"]').addClass('is-invalid');
            showMessage(".observations-error",'Las observaciones del producto son requeridas.');
            error++;
        }else{
            cleanMessage('input[name="observations"]',".observations-error");
        }
        if(category_id == '') {
            form.find('select[name="category_id"]').addClass('is-invalid');
            showMessage(".category-error",'La categoría del producto es requerida.');
            error++;
        }else{
            cleanMessage('select[name="category_id"]',".category-error");
        }
        if (!isValidArray(warehouses_id)) {
            form.find('input[name="warehouse_ids[]"]').addClass('is-invalid');
            showMessage(".warehouse-error",'Debe seleccionar al menos un almacén.');
            error++;
        }else {
            cleanMessage('input[name="warehouse_ids[]"]',".warehouse-error");
        }
        if(error != 0) {
            return false;
        }
        return true;
    }


    function showMessage(className, message) {
        $(className).text(message);
    }

    function cleanMessage(input, className){
        $(className).empty();
        $(input).removeClass('is-invalid');
    }
    function isValidArray(value) {
        return value !== undefined && value !== null && value !== '';
    }

});

