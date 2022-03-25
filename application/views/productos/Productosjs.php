<script>
    $(function(){
        cargar_contenido();

        $(document).on('click','#btn_nuevo_producto',function(){
           $.ajax({
                url : "<?=base_url('productos/abrir_formulario')?>",
                method : "get",
                success : function(respuesta){
                    $(document).find('#contenido_modal').empty().append(respuesta);
                }
           });
       });

       $(document).on('submit','#form_productos',function(event){
            event.preventDefault();

            $(this).find('input').each(function(elemento){
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });
            var data = $(this).serialize();
            $.ajax({
                url : "<?=base_url('productos/procesar_formulario')?>",
                method : "post",
                data : data,
                dataType : "json",
                success : function(respuesta){
                    console.log(respuesta.mensaje);
                    if (respuesta.estatus == "incorrecto") {
                        if (respuesta.errores) {
                            $.each(respuesta.errores,function(variable,value){
                                $(document).find('#'+variable).addClass('is-invalid');
                                $(document).find('#'+variable).after('<div class="invalid-feedback">'+value+'</div>');
                            });
                        } else {
                            $(document).find('#modal_productos').modal('hide');
                            cargar_contenido();
                            var toast = cuteAlert({
                                type : "danger",
                                img : "img/error.svg",
                                title : "La informaci&oacute;n no pudo ser registrada",
                                message : respuesta.mensaje,
                                buttonText : "Ok"
                            });
                            return toast;
                        }
                    } else if(respuesta.estatus == "correcto"){
                        $(document).find('#modal_productos').modal('hide');
                        cargar_contenido();
                        var toast = cuteAlert({
                            type : "success",
                            img : "img/success.svg",
                            title : "Informaci&oacute;n",
                            message : respuesta.mensaje,
                            buttonText : "Ok"
                        });
                        return toast;
                    }
                }
           });
        });

        $(document).on('click', '.btn_operacion', function(){
            var codigo_producto = $(this).attr('data-codigo');
            var accion = $(this).attr('data-opt');
            $.ajax({
                url : "<?=base_url('productos/abrir_formulario?codigo_producto=')?>" + codigo_producto+"&accion="+accion,
                method : "get",
                success : function(respuesta){
                    $(document).find('#contenido_modal').empty().append(respuesta);
                    $(document).find('#modal_productos').modal('show');
                }
            });
       });
    
    });

    function cargar_contenido(){
        $.ajax({
                url : "<?=base_url('productos/mostrarContenido')?>",
                method : "get",
                success : function(respuesta){
                    $(document).find('#registro_contenido').empty().append(respuesta);

                    setTimeout(function(){
                        $(document).find('#tabla_productos').DataTable({
                            responsive : true
                        });
                    }, 100);
                }
        });
    }
</script>