<div class="modal-header">
    <h5 class="modal-title">Consulta de productos</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div>Sku</div>
            <input type="text" onkeypress='return validaNumericos(event)' maxlength="6" class="form-control" name="sku_p" id="sku_p">
        </div>
        <div class="col-6">
            <br>
            <button class="btn btn-primary" id="buscar_producto"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <div class="col-12">
            <div id="contenido_busqueda">
    
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>

<script>
    
    $("#buscar_producto").on("click",function(){
        if ($("#sku_p").val() != ""){
            var codigo = $("#sku_p").val();
            $.ajax({
                url : "<?=base_url('home/consultar_sku')?>",
                method : "post",
                data:{sku: codigo,accion: "consultar"},
                success : function(respuesta){
                   $("#contenido_busqueda").empty().append(respuesta);
                }
            });
        }else{
            Swal.fire({
                icon: 'warning',
                title: "Ingrese un sku para buscar",
                showConfirmButton: true,
            });   
        }
    })

</script>