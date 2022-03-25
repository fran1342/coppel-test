
<table id="tabla_veterinarios" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Tel(s)</th>
                        <th>Especialidad</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($veterinarios as $iVeterinario){ ?>
                        <tr>
                        <td><?=$iVeterinario->id_medico;?></td>
                        <td><?=$iVeterinario->nombre_usuario;?></td>
                        <td><?=$iVeterinario->apellidos_usuario;?></td>
                        <td><?=$iVeterinario->tel_usuario;?></td>
                        <td><?=$iVeterinario->especialidad_medico;?></td>
                        <td><?=$iVeterinario->estatus_usuario;?></td>
                        <td>
                            <button class="btn btn-primary btn-sm btn_operacion" data-codigo="<?=$iVeterinario->id_usuario;?>" data-opt="editar">
                            <i class="fas fa-edit"></i>Editar
                            </button>
                            <button class="btn btn-danger btn-sm btn_operacion" data-codigo="<?=$iVeterinario->id_usuario;?>" data-opt="borrar">
                            <i class="fas fa-trash"></i>Borrar
                            </button>
                        </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>