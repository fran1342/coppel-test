
<table id="tabla_empleados" class="table table-bordered table-striped">
                <thead>
                    <tr>   
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Tel(s)</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <?php 
                    //var_dump($empleados);
                    //echo $empleados;
                ?>
                <tbody>
                    <?php foreach($empleados as $iEmpleado){ ?>
                        <tr>
                        <td><?=$iEmpleado->nombre_usuario;?></td>
                        <td><?=$iEmpleado->apellidos_usuario;?></td>
                        <td><?=$iEmpleado->tel_usuario;?></td>
                        <td><?=$iEmpleado->user_usuario;?></td>
                        <td><?=$iEmpleado->tipo_usuario;?></td>
                        <td><?=$iEmpleado->estatus_usuario;?></td>
                        <td>
                            <button class="btn btn-primary btn-sm btn_operacion" data-codigo="<?=$iEmpleado->id_usuario;?>" data-opt="editar">
                            <i class="fas fa-edit"></i>Editar
                            </button>
                            <button class="btn btn-danger btn-sm btn_operacion" data-codigo="<?=$iEmpleado->id_usuario;?>" data-opt="borrar">
                            <i class="fas fa-trash"></i>Borrar
                            </button>
                        </td>
                        </tr>
                    <?php }?>
                </tbody>

            </table>