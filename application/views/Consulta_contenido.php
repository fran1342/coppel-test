<?php if(@$status == "correcto"){ ?>
        <hr>
        <div class="row">
            <div class="col-6">
                <strong>Sku: </strong><?=@$data->producto_sku;?>
            </div>
            <div class="col-6">
                <strong>¿Descontinuado? </strong><?= (@$data->producto_descontinuado == 1) ? 'Si' : "No"; ?>
            </div>
            <div class="col-6">
                <strong>Articulo: </strong><?=@$data->producto_articulo;?>
            </div>
            <div class="col-6">
                <strong>Modelo: </strong><?=@$data->producto_modelo;?>
            </div>
            <div class="col-6">
                <strong>Marca: </strong><?=@$data->producto_marca;?>
            </div>
            <div class="col-6">
                <strong>Departamento: </strong><?=@$data->departamento_nombre;?>
            </div>
            <div class="col-6">
                <strong>Clase: </strong><?=@$data->clase_nombre;?>
            </div>
            <div class="col-6">
            <strong>Familia: </strong><?=@$data->familia_nombre;?>
            </div>
            <div class="col-6">
                <strong>Stock: </strong><?=@$data->producto_stock;?>
            </div>
            <div class="col-6">
                <strong>Cantidad: </strong><?=@$data->producto_cantidad;?>
            </div>
            <div class="col-6">
                <strong>Fecha de alta: </strong><?=@$data->producto_fecha_alta;?>
            </div>
            <div class="col-6">
                <strong>Fecha de baja: </strong><?=@$data->producto_fecha_baja;?>
            </div>
        
        </div>
<?php }else{?>
    <script>
         Swal.fire({
            icon: 'warning',
            title: "No se encontró un producto con ese sku",
            showConfirmButton: true,
        });   
    </script>
<?php }?>