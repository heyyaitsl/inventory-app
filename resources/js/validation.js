$(document).ready(function() {
    $('.product-form').submit(function(e) {
        e.preventDefault();
        
        if(validateProductForm($(this))) {
            sendFormWithAjax($(this));
        }else {
            alert('Formuario no válido. Corrija los errores en el formulario.');
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
       
        form.find('input[name="name"]').removeClass('is-invalid');
        return true;
    }

    function validateWarehouseForm(form) {
        var name = form.find('input[name="name"]').val();

        if(name == '') {
            form.find('input[name="name"]').addClass('is-invalid');
            showMessage(".name-error",'El nombre del almacén es requerido.');
            return false;
        }
       
        form.find('input[name="name"]').removeClass('is-invalid');
        return true;
    }

    function showMessage(className, message) {
        $(className).text(message);
    }
});

