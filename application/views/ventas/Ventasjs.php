<script>
    $(function(){
        cargar_contenido();

        $(document).on('click','#btn_nueva_venta',function(){
           $.ajax({
                url : "<?=base_url('ventas/abrir_formulario')?>",
                method : "get",
                success : function(respuesta){
                    $(document).find('#contenido_modal').empty().append(respuesta);
                }
           });
       });

       $(document).on('click', '.btn_operacion', function(){
            var codigo_venta = $(this).attr('data-codigo');
            var accion = $(this).attr('data-opt');
            $.ajax({
                url : "<?=base_url('ventas/abrir_formulario?codigo_venta=')?>" + codigo_venta+"&accion="+accion,
                method : "get",
                success : function(respuesta){
                    $(document).find('#contenido_modal').empty().append(respuesta);
                    $(document).find('#modal_ventas').modal('show');
                }
            });
       });

    });


    function cargar_contenido(){
        $.ajax({
                url : "<?=base_url('ventas/mostrarContenido')?>",
                method : "get",
                success : function(respuesta){
                    $(document).find('#registro_contenido').empty().append(respuesta);

                    setTimeout(function(){
                        $(document).find('#tabla_ventas').DataTable({
                            responsive : true
                        });
                    }, 100);
                }
        });
    }
</script>