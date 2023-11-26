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
        }else {
            alert('Formuario no válido. Corrija los errores en el formulario.');
        }
    });

    $('.warehouse-form').submit(function(e) {
        e.preventDefault();
        
        if(validateWarehouseForm($(this))) {
            sendFormWithAjax($(this));
        }else {
            alert('Formuario no válido. Corrija los errores en el formulario.');
        }
    });

    function sendFormWithAjax(form) {
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    alert(response.message);
                    window.location.href = response.redirect;
                }else {
                    alert(response.message);
                }
            },
            error: function(response) {
                alert('Error al enviar el formulario.');
            }
        });
    }

    function validateCategoryForm(form) {
        var name = form.find('input[name="name"]').val();

        if(name == '') {
            form.find('input[name="name"]').addClass('is-invalid');
            return false;
        }

        if(name.length < 10) {
            form.find('input[name="name"]').addClass('is-invalid');
            return false;
        }
        
        form.find('input[name="name"]').removeClass('is-invalid');
        return true;
    }
});

