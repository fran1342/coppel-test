
<table id="tabla_productos" class="table table-bordered table-striped">
                <thead>
                    <tr>   
                        <th>ID Producto</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Tipo</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($productos as $iProducto){ ?>
                        <tr>
                        <td><?=$iProducto->id_producto;?></td>
                        <td><?=$iProducto->nombre_producto;?></td>
                        <td><?=$iProducto->descripcion_producto;?></td>
                        <td>$<?=$iProducto->precio_producto;?></td>
                        <td><?=$iProducto->stock_producto?></td>
                        <td><?=$iProducto->tipo_producto;?></td>
                        <td><?=$iProducto->estatus_producto;?></td>
                        <td>
                            <button class="btn btn-primary btn-sm btn_operacion" data-codigo="<?=$iProducto->id_producto;?>" data-opt="editar">
                            <i class="fas fa-edit"></i>Editar
                            </button>
                            <button class="btn btn-danger btn-sm btn_operacion" data-codigo="<?=$iProducto->id_producto;?>" data-opt="borrar">
                            <i class="fas fa-trash"></i>Borrar
                            </button>
                        </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>