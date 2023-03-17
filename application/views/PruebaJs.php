<script>
 
$(function(){
    $(document).on('click','#btn_nuevo_producto',function(){
        $.ajax({
            url : "<?=base_url('home/abrir_formulario')?>",
            method : "get",
            success : function(respuesta){
                $(document).find('#contenido_modal').empty().append(respuesta);
            }
        });
    });

    $(document).on('submit','#form_prueba',function(event){
            event.preventDefault();

            $(this).find('input').each(function(elemento){
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });
            var data = $(this).serialize();
            $.ajax({
                url : "<?=base_url('home/procesar_formulario')?>",
                method : "post",
                data : data,
                dataType : "json",
                success : function(respuesta){
                    if (respuesta.estatus == "incorrecto") {
                        if (respuesta.errores) {
                            $.each(respuesta.errores,function(variable,value){
                                $(document).find('#'+variable).addClass('is-invalid');
                                $(document).find('#'+variable).after('<div class="invalid-feedback">'+value+'</div>');
                            });
                        } else {
                            $(document).find('#modal_productos').modal('hide');
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

        $(document).on('click','#btn_consulta_producto',function(){
        $.ajax({
            url : "<?=base_url('home/abrir_modal_informacion')?>",
            method : "get",
            success : function(respuesta){
                $(document).find('#contenido_ver_modal').empty().append(respuesta);
            }
        });
    });
});

function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}
</script>