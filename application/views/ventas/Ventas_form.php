<form id="form_ventas">

<?php if(@$venta_seleccionada){ ?> 
    <input type="hidden" name="clave_v" id="clave_v" value="<?=@$venta_seleccionada->id_venta;?>">
    <input type="hidden" name="accion" id="accion" value="<?=@$accion;?>">
<?php }?>

<div class="modal-header">

<?php
        if (@$accion) {
        if ($accion == "borrar") {
         $titulo = "Borrar";
         
        } else {
            $titulo = "Editar";
            
        }
      
        } else {
        $titulo = "Registrar";
        }
    ?>

  <h5 class="modal-title">Ticket</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<div class="row">
<div class=" col-12 col-sm-6 form-group">
        <label>ID de la venta: </label>
        <label for=""><?=@$venta_seleccionada->id_venta;?></label>
    </div>
    <div class="col-12 col-sm-6 form-group">
        <label>Fecha: </label>
        <label for=""><?=@$venta_seleccionada->fecha_venta;?></label>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach(@$detalle as $producto){ ?>
                <tr>
                    <td><?php echo $producto->nombre_producto ?></td>
                    <td><?php echo $producto->cantidad_detalleV ?></td>
                    <td>$<?php echo $producto->precio_producto ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-12 col-sm-6 form-group">
        <label>Empleado: </label>
        <label for=""><?=@$venta_seleccionada->nombre_usuario;?></label>
    </div>
    <div class="col-12 col-sm-6 form-group">
        <label>Total: </label>
        <label for="">$<?=@$venta_seleccionada->total;?></label>
    </div>

</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
  <!--<button type="button" class="btn btn-primary">Agregar</button> -->
</div>
</form>