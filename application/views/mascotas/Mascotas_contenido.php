
<table id="tabla_mascotas" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Raza</th>
                        <th>Edad</th>
                        <th>Propietario</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($mascotas as $iMascota){ ?>
                        <tr>
                        <td><img src="<?=$iMascota->foto_mascota?>" width="90" height="90" alt=""></td>         
                        <td><?=$iMascota->nombre_mascota;?></td>
                        <td><?=$iMascota->raza_mascota;?></td>
                        <td><?=$iMascota->edad_mascota?></td>
                        <td><?=$iMascota->nombre_usuario;?></td>
                        <td><?=$iMascota->estatus_mascota;?></td>
                        <td>
                            <button class="btn btn-primary btn-sm btn_operacion" data-codigo="<?=$iMascota->id_mascota;?>" data-opt="editar">
                            <i class="fas fa-edit"></i>Editar
                            </button>
                            <button class="btn btn-danger btn-sm btn_operacion" data-codigo="<?=$iMascota->id_mascota;?>" data-opt="borrar">
                            <i class="fas fa-trash"></i>Borrar
                            </button>
                        </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>