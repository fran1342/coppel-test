<script>
    $(function(){
        cargar_contenido();

        $(document).on('click','#btn_nueva_mascota',function(){
           $.ajax({
                url : "<?=base_url('mascotas/abrir_formulario')?>",
                method : "get",
                success : function(respuesta){
                    $(document).find('#contenido_modal').empty().append(respuesta);
                }
           });
       });

       $(document).on('submit','#form_mascotas',function(event){
            event.preventDefault();
            var data = new FormData($(this)[0]);
            $(this).find('input').each(function(elemento){
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });
            //var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url : "<?=base_url('mascotas/procesar_formulario')?>",
                method: "POST",
                contentType: false,
                cache: false,
                processData: false,
                data : data,
                success : function(respuesta){
                    respuesta = JSON.parse(respuesta);
                    console.log(respuesta.mensaje);
                    if (respuesta.estatus == "incorrecto") {
                        if (respuesta.errores) {
                            $.each(respuesta.errores,function(variable,value){
                                $(document).find('#'+variable).addClass('is-invalid');
                                $(document).find('#'+variable).after('<div class="invalid-feedback">'+value+'</div>');
                            });
                        } else {
                            $(document).find('#modal_mascotas').modal('hide');
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
                        $(document).find('#modal_mascotas').modal('hide');
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
            var codigo_mascota = $(this).attr('data-codigo');
            var accion = $(this).attr('data-opt');
            $.ajax({
                url : "<?=base_url('mascotas/abrir_formulario?codigo_mascota=')?>" + codigo_mascota+"&accion="+accion,
                method : "get",
                success : function(respuesta){
                    $(document).find('#contenido_modal').empty().append(respuesta);
                    $(document).find('#modal_mascotas').modal('show');
                }
            });
       });

    });

    function cargar_contenido(){
        $.ajax({
                url : "<?=base_url('mascotas/mostrarContenido')?>",
                method : "get",
                success : function(respuesta){
                    $(document).find('#registro_contenido').empty().append(respuesta);

                    setTimeout(function(){
                        $(document).find('#tabla_mascotas').DataTable({
                            responsive : true
                        });
                    }, 100);
                }
        });
    }
</script>