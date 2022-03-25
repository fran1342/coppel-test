<table id="tabla_ventas" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Empleado</th>
                    <th>Acción</th>
                  </tr>
                </thead>

                <tbody>
                <?php foreach($ventas as $iVenta){ ?>
                        <tr>
                            <td><?=$iVenta->id_venta;?></td>
                            <td><?=$iVenta->fecha_venta;?></td>
                            <td>$<?=$iVenta->total;?></td>
                            <td><?=$iVenta->nombre_usuario;?></td>
                            <td>
                            <button class="btn btn-success btn-sm btn_operacion"  data-codigo="<?=$iVenta->id_venta;?>" data-opt="borrar">
                            <i class="fa fa-sticky-note"></i> Ver ticket
                            </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

              </table>