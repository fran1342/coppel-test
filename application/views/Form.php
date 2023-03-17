<form id="form_prueba">
    <div class="modal-header">
        <h5 class="modal-title">Formulario productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <label>Sku:</label>
                <input type="text" onkeypress='return validaNumericos(event)' maxlength="6" class="form-control" name="sku_p" id="sku_p">
            </div>
            <div class="col-6">
                <br><br>
                <input disabled  type="checkbox" name="descontinuado_p" id="descontinuado_p">
                <label>Descontinuado</label>
            </div>
            <div class="col-12">
                <label>Articulo</label>
                <input type="text" disabled maxlength="15" class="form-control" name="articulo_p" id="articulo_p">
            </div>
            <div class="col-12">
                <label>Marca</label>
                <input type="text" disabled maxlength="15" class="form-control" name="marca_p" id="marca_p">
            </div>
            <div class="col-12">
                <label>Modelo</label>
                <input type="text" disabled maxlength="20" class="form-control" name="modelo_p" id="modelo_p">
            </div>
            <div class="col-12">
                <label>Departamento</label>
                <select disabled aria-placeholder="Selecciona una opcion" class="form-control" name="depa_p" id="depa_p">
                    <option value="" selected disabled>Selecciona una opcion</option>
                    <?php foreach($departamentos as $iDepa){ ?>
                        <option value="<?=$iDepa->departamento_id;?>"><?=$iDepa->departamento_nombre;?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12">
                <label>Clase</label>
                <select class="form-control" disabled="disabled" name="clase_p" id="clase_p">
                    <option value="" selected disabled>Selecciona una opcion</option>
                </select>
            </div>
            <div class="col-12">
                <label>Familia</label>
                <select class="form-control" disabled="disabled" name="familia_p" id="familia_p">
                    <option value="" selected disabled>Selecciona una opcion</option>
                </select>
            </div>
            <div class="col-6">
                <label>Stock</label>
                <input type="text" onkeypress='return validaNumericos(event)' disabled maxlength="9" class="form-control" name="stock_p" id="stock_p">
            </div>
            <div class="col-6">
                <label>Cantidad</label>
                <input type="text" onkeypress='return validaNumericos(event)' disabled maxlength="9" class="form-control" name="cantidad_p" id="cantidad_p">
            </div>
        </div>
    </div>
    <div class="modal-footer">
            <button type="button" id="deleteProduct" hidden class="btn btn-danger" data-opt="borrar">Eliminar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>

<script>
$("#sku_p").on("change",function(){
    if($("#sku_p").val() != ""){
        var skuValue = $("#sku_p").val();
        $.ajax({
        url:'<?=base_url('home/consultar_sku')?>',
        method: 'post',
        data: {sku: skuValue},
        dataType: 'json',
        beforeSend: function(){
            Swal.fire({
                title: "Espere un momento por favor",
                icon: 'warning',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });
        },
        success: function(response){
            Swal.close();
            if (response.status == "error") {
                $("#articulo_p").val("")
                $("#marca_p").val("")
                $("#modelo_p").val("")
                $("#depa_p").val("")
                $("#clase_p").val("")
                $('#clase_p').find('option').not(':first').remove();
                $("#familia_p").val("")
                $('#familia_p').find('option').not(':first').remove();
                $("#stock_p").val("")
                $("#cantidad_p").val("")
                $("#articulo_p").removeAttr("disabled")
                $("#marca_p").removeAttr("disabled")
                $("#modelo_p").removeAttr("disabled")
                $("#depa_p").removeAttr("disabled")
                $("#stock_p").removeAttr("disabled")
                $("#cantidad_p").removeAttr("disabled")
                $("#deleteProduct").attr("hidden",true)

                Swal.fire({
                    icon: 'success',
                    title: response.mensaje,
                    showConfirmButton: false,
                    timer: 2500
                });   
            }else{
                
                $("#descontinuado_p").removeAttr("disabled")
                $("#articulo_p").removeAttr("disabled")
                $("#marca_p").removeAttr("disabled")
                $("#modelo_p").removeAttr("disabled")
                $("#depa_p").removeAttr("disabled")
                $("#stock_p").removeAttr("disabled")
                $("#cantidad_p").removeAttr("disabled")

                $("#articulo_p").val(response.data.producto_articulo)
                $("#marca_p").val(response.data.producto_marca)
                $("#modelo_p").val(response.data.producto_modelo)
                $("#stock_p").val(response.data.producto_stock)
                $("#cantidad_p").val(response.data.producto_cantidad)
                if (response.data.producto_descontinuado == 0 || response.data.producto_descontinuado == "0") {
                    $("#descontinuado_p").prop("checked",false)
                }else{
                    $("#descontinuado_p").prop("checked",true)
                }
                $("#depa_p option").each(function(){
                    if ($(this).val() == response.data.fk_departamento) {
                        $(this).attr("selected",true);
                    }else{
                        $(this).removeAttr("selected");
                    }
                });
                $("#deleteProduct").attr("hidden",false)
                $("#deleteProduct").attr("data-codigo",response.data.producto_sku)

                getSelectOptions(response.data.fk_departamento,response.data.fk_clase,response.data.fk_familia);

                Swal.fire({
                    icon: 'success',
                    title: response.mensaje,
                    showConfirmButton: false,
                    timer: 2500
                });   
            }
        }
     });
    }
})

function getSelectOptions(id_depa, id_clas, id_fam){
    $.ajax({
        url: "<?= base_url('home/consultar_opciones') ?>",
        method:"post",
        dataType: "json",
        data:{depa_id: id_depa, clas_id:id_clas, fam_id:id_fam},
        success:function(response){
            $('#clase_p').find('option').removeAttr("selected");
            $.each(response.clases,function(index,data){
                selected = null;
                if (data['clase_id'] == id_clas) {
                    var selected = 'selected' 
                }
                $('#clase_p').append('<option '+ selected +' value="'+data['clase_id']+'">'+data['clase_nombre']+'</option>');
            });
            $('#clase_p').removeAttr("disabled")

            $('#familia_p').find('option').removeAttr("selected");
            $.each(response.familias,function(index,data){
                selected = null;
                if (data['familia_id'] == id_fam) {
                    var selected = 'selected' 
                }
                $('#familia_p').append('<option '+ selected +' value="'+data['familia_id']+'">'+data['familia_nombre']+'</option>');
            });
            $('#familia_p').removeAttr("disabled")
        }
    });
}

$("#depa_p").on("change",function(){
    var depa = $("#depa_p").val();
    $.ajax({
        url:'<?=base_url('home/obtener_clases')?>',
        method: 'post',
        data: {departamento: depa},
        dataType: 'json',
        beforeSend: function(){
            Swal.fire({
                title: "Espere un momento por favor",
                icon: 'warning',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });
        },
        success: function(response){
            // Remove options 
            $('#clase_p').find('option').not(':first').remove();
            $('#clase_p').find('option').attr("selected",true)
            $('#familia_p').find('option').not(':first').remove();
            $('#familia_p').prop("selectedIndex", 0);

            // Add options

            $.each(response,function(index,data){
                $('#clase_p').append('<option value="'+data['clase_id']+'">'+data['clase_nombre']+'</option>');
            });
            $('#clase_p').removeAttr("disabled")
            Swal.close();
            Swal.fire({
                icon: 'success',
                title: "Listo puede continuar",
                showConfirmButton: false,
                timer: 1500
            });
        }
     });
});

$("#clase_p").on("change",function(){
    var clas = $("#clase_p").val();
    $.ajax({
        url:'<?=base_url('home/obtener_familias')?>',
        method: 'post',
        data: {clase: clas},
        dataType: 'json',
        beforeSend: function(){
            Swal.fire({
                title: "Espere un momento por favor",
                icon: 'warning',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });
        },
        success: function(response){
            // Remove options 
            $('#familia_p').find('option').not(':first').remove();
            $('#familia_p').find('option').attr("selected",true)
            // Add options
            $.each(response,function(index,data){
                $('#familia_p').append('<option value="'+data['familia_id']+'">'+data['familia_nombre']+'</option>');
            });
            $('#familia_p').removeAttr("disabled")
            Swal.close();
            Swal.fire({
                icon: 'success',
                title: "Listo puede continuar",
                showConfirmButton: false,
                timer: 1500
            });
        }
     });
});

$("#cantidad_p").on("change",function(){
    var cantidad = parseInt($("#cantidad_p").val());
    var stock = parseInt($("#stock_p").val())
    if( cantidad > stock ){
        $("#cantidad_p").val("");
        Swal.fire({
            icon: 'warning',
            title: "La cantidad no puede ser mayor al stock",
            showConfirmButton: true,
        });
    }
})

$("#deleteProduct").on("click",function(){
    var codigo = $(this).attr("data-codigo");
    var borrar = $(this).attr("data-opt");
    Swal.fire({
        title: '¿Seguro que quiere borrar el producto?',
        text: "No podrá revertir el cambio",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : "<?=base_url('home/procesar_formulario')?>",
                method : "post",
                data:{sku_p: codigo,accion: borrar},
                success : function(respuesta){
                    location.reload()
                    Swal.fire(
                    'Borrado!',
                    'El producto fue borrado correctamente',
                    'success'
                    )
                }
            });

        }
    })
})
</script>
