$(document).ready(function() {
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Please enter only letters");
 
    // validate contact form on keyup and submit
    $("#form").validate({
 
        //set the rules for the fild names
        rules: {
            nombre: {
                required: true,
                minlength: 3,
                maxlength:100,
                
            },
            dni: {
                required: true,
                minlength: 7,
                maxlength:35,
                
            },
            dominio: {
                required: true,
                
            },
            
        },
 
        //set error messages
        messages: {
 
            nombre: {
                required: "Su nombre es un campo requerido.",
                minlength: "El nombre es demasiado corto",
                maxlength: "El nombre es demasiado largo"
            },
            dni: {
                required: "Es un campo requerido.",
                minlength: "El nombre es demasiado corto",
                maxlength: "El nombre es demasiado largo"
            },
            dominio:{ 
                required: "Es un campo requerido.",
                minlength: "El interno es de 4 digitos",
                maxlength: "El interno es de 4 digitos"
            }
            
            
        },
 
        //our custom error placement
        errorElement: "span",
        errorPlacement: function(error, element) {
                error.appendTo(element.parent());
            }
 
    });
});