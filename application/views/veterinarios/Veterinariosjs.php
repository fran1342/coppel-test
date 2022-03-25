<script>
    $(function(){
        cargar_contenido();
    });

    function cargar_contenido(){
        $.ajax({
                url : "<?=base_url('veterinarios/mostrarContenido')?>",
                method : "get",
                success : function(respuesta){
                    $(document).find('#registro_contenido').empty().append(respuesta);

                    setTimeout(function(){
                        $(document).find('#tabla_veterinarios').DataTable({
                            responsive : true
                        });
                    }, 100);
                }
        });
    }
</script>